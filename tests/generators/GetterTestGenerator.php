<?php

namespace Epeiros;

use ReflectionClass;
use ReflectionParameter;

require __DIR__ . '/../../../src/autoload.php';

$generator = new GetterTestGenerator();

/**
 * Enter the appropriate class within $classToTest, to have a test generated in this directory
 * with a setup and mocked constructor parameters. Tests for the getters will be generated and should
 * be edited to taste. If the properties are scalars, stubs will be created but you must define these
 * yourself (may change with php7 type hints).
 */
$classToTest = \stdClass::class;

$generator->generate(new ReflectionClass($classToTest));

class GetterTestGenerator
{
    /**
     * @param ReflectionClass $reflection
     */
    public function generate($reflection)
    {
        $className  = $reflection->getShortName();
        $namespace  = $reflection->getNamespaceName();
        $properties = $reflection->getConstructor()->getParameters();

        $this->writeFile($className, $namespace, $properties);
    }

    /**
     * @param $className
     * @param $namespace
     * @param ReflectionParameter[] $properties
     */
    private function writeFile($className, $namespace, $properties)
    {
        $resource = fopen(__DIR__ . 'GetterTestGenerator.php/' . $className . 'Test.php', 'w');

        $text = '<?php' . "\n\n";

        $text .= 'namespace ' . $namespace . ";\n\n";

        foreach ($properties as $property) {
            if ($property->getClass() !== null) {
                if ($property->getClass()->getNamespaceName() != $namespace) {
                    $text .= 'use ' . $property->getClass()->name . ";\n";
                }
            }
        }
        $text .= "\n";

        $text .= '/**' . "\n";
        $text .= ' * @covers \\' . $namespace . '\\' . $className . "\n";
        $text .= ' */' . "\n";

        $text .= 'class ' . $className . 'Test extends \PHPUnit_Framework_TestCase' . "\n";
        $text .= '{' . "\n";

        foreach ($properties as $property) {
            $text .= '    /**' . "\n";
            if ($property->getClass() === null) {
                $text .= '     * @var ' . "\n";
            }
            else {
                $text .= '     * @var ' . $property->getClass()->getShortName(
                    ) . ' | \PHPUnit_Framework_MockObject_MockObject' . "\n";
            }
            $text .= '     */' . "\n";
            $text .= '    private $' . $property->name . 'Mock' . ';' . "\n\n";
        }

        $text .= '    /**' . "\n";
        $text .= '     * @var ' . $className . "\n";
        $text .= '     */' . "\n";
        $text .= '    private $' . lcfirst($className) . ';' . "\n\n";

        $text .= '    protected function setUp()' . "\n";
        $text .= '    {' . "\n";

        foreach ($properties as $property) {
            if ($property->getClass() === null) {
                $text .= '        $this->' . $property->name . 'Mock' . " = 'fill in';\n";
            }
            else {
                $text .= '        $this->' . $property->name . 'Mock' . ' = $this->createMock(' . $property->getClass()
                                                                                                  ->getShortName(
                                                                                                  ) . '::class);' . "\n";
            }
        }

        $text .= "\n" . '        $this->' . lcfirst($className) . ' = new ' . $className . '(';
        foreach ($properties as $property) {
            if ($property == end($properties)) {
                $text .= '$this->' . $property->name . 'Mock';
            }
            else {
                $text .= '$this->' . $property->name . 'Mock' . ', ';
            }
        }
        $text .= ');' . "\n";

        $text .= '    }' . "\n\n";

        foreach ($properties as $property) {
            $text .= '    public function test' . ucfirst($property->name) . 'CanBeRetrieved()' . "\n";
            $text .= '    {' . "\n";
            $text .= '        $this->assertEquals($this->' . $property->name . 'Mock' . ', $this->' . lcfirst(
                    $className
                ) . '->' . $property->name . '());' . "\n";
            $text .= '    }' . "\n\n";
        }
        $text .= '}';

        fwrite($resource, $text);
        fclose($resource);
    }
}

