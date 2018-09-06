<?php

namespace Epeiros;

use Epeiros\Http\Request;

require __DIR__ . '/../src/autoload.php';

$configData  = require(__DIR__ . '/../src/configuration/epeirosConfig.php');

$config = new AppConfig($configData);

$factory = new Factory($config);

$request = Request::fromSuperGlobals();

$application = $factory->createApplication();

$response = $application->run($request);

$response->send();
