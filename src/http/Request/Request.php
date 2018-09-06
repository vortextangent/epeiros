<?php
namespace Epeiros\Http;

use Epeiros\Library\NotFoundInCollectionException;
use Epeiros\Library\RuntimeException;

class Request
{
    /**
     * @var Path
     */
    private $path;

    /**
     * @var ParameterCollection
     */
    private $parameters;

    /**
     * @var SessionId
     */
    private $sessionId;

    /**
     * @var ParameterCollection
     */
    private $cookies;

    /**
     * @var UploadFileCollection
     */
    private $uploadFileCollection;

    /**
     * @throws RuntimeException
     * @return Request
     */
    public static function fromSuperGlobals()
    {
        $requestPath = new Path(rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "\t\n\r\0\x0B/"));

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                return new GetRequest(
                    $requestPath,
                    ParameterCollection::fromArray($_GET),
                    ParameterCollection::fromArray($_COOKIE),
                    new UploadFileCollection()
                );
                break;

            case 'POST':
                return new PostRequest(
                    $requestPath,
                    ParameterCollection::fromArray($_POST),
                    ParameterCollection::fromArray($_COOKIE),
                    UploadFileCollection::fromArray($_FILES)
                );
                break;

            default:
                throw new RuntimeException;
        }
    }

    /**
     * @param Path $path
     * @param ParameterCollection $parameters
     * @param ParameterCollection $cookies
     * @param UploadFileCollection $uploadFileCollection
     */
    public function __construct(
        Path $path,
        ParameterCollection $parameters,
        ParameterCollection $cookies,
        UploadFileCollection $uploadFileCollection
    ) {
        $this->path                 = $path;
        $this->parameters           = $parameters;
        $this->cookies              = $cookies;
        $this->uploadFileCollection = $uploadFileCollection;
    }

    /**
     * @return bool
     */
    public function isGetRequest()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPostRequest()
    {
        return false;
    }

    /**
     * @return Path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param $name
     * @return Parameter
     * @throws NotFoundInCollectionException
     */
    public function getParameterByName($name)
    {
        if (!$this->hasParameter($name)) {
            throw new NotFoundInCollectionException('There is no parameter named:' . $name);
        }

        return $this->parameters->getElementByIdentifier(new ParameterIdentifier($name));
    }

    public function getValueByName($name)
    {
        return $this->getParameterByName($name)->getValue();
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasParameter($name)
    {
        return $this->parameters->hasParameterByName($name);
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasNonEmptyParameter($name)
    {
        return $this->hasParameter($name) && !empty($this->getValueByName($name));
    }

    /**
     * @return SessionId
     */
    public function getSessionId()
    {
        if (empty($this->sessionId)) {
            $this->sessionId = SessionId::fromRequest($this);
        }

        return $this->sessionId;
    }

    /**
     * @param $name
     * @return Parameter
     * @throws NotFoundInCollectionException
     */
    public function getCookieByName($name)
    {
        if (!$this->hasCookie($name)) {
            throw new NotFoundInCollectionException('There is no cookie named:' . $name);
        }

        return $this->cookies->getParameterByName($name);
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasCookie($name)
    {
        return $this->cookies->hasParameterByName($name);
    }

    /**
     * @return ParameterCollection
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasUploadFile($name)
    {
        return $this->uploadFileCollection->hasUploadFile($name);
    }

    /**
     * @param string $name
     * @throws RuntimeException
     * @return UploadFile
     */
    public function getUploadFileByName($name)
    {
        return $this->uploadFileCollection->getUploadFile($name);
    }

    /**
     * @return UploadFileCollection
     */
    public function uploadFiles()
    {
        return $this->uploadFileCollection;
    }
}
