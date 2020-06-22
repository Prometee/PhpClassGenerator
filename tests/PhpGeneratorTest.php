<?php

namespace Tests\Prometee\PhpClassGenerator;

use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use Prometee\PhpClassGenerator\Builder\ClassBuilder;
use Prometee\PhpClassGenerator\Builder\ModelFactoryBuilder;
use Prometee\PhpClassGenerator\Builder\ViewFactoryBuilder;
use Prometee\PhpClassGenerator\PhpGeneratorInterface;
use stdClass;

class PhpGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $basePath = __DIR__ . '/../etc/build/Dummy';
        $baseNamespace = 'Tests\\Dummy';

        $classesConfig = [
            'Foo' => [
                'anArrayOfItems' => [
                    'types' => [
                        $baseNamespace . '\\Foo[]',
                        'null'
                    ],
                    'defaultValue' => null,
                    'description' => 'My array field description' . "\n" . 'with line break'
                ],
                'aBoolField' => [
                    'types' => [
                        'bool'
                    ],
                    'defaultValue' => 'false',
                    'description' => 'My bool field description'
                ],
                'aStringField' => [
                    'types' => [
                        'string'
                    ],
                    'defaultValue' => '\'\'',
                    'description' => 'My string field description'
                ],
                'aFloatField' => [
                    'types' => [
                        'float'
                    ],
                    'defaultValue' => '0.0',
                    'description' => 'My float field description'
                ],
                'aIntegerField' => [
                    'types' => [
                        'int'
                    ],
                    'defaultValue' => '0',
                    'description' => 'My integer field description'
                ],
                'aMixedField' => [
                    'types' => [
                        'mixed',
                        'null'
                    ],
                    'defaultValue' => null,
                    'description' => 'My mixed field description'
                ],
                'aDateTimeField' => [
                    'types' => [
                        DateTimeInterface::class,
                        'null'
                    ],
                    'defaultValue' => null,
                    'description' => 'My date time field description'
                ],
            ],
        ];

        $classBuilder = new ClassBuilder(
            new ModelFactoryBuilder(),
            new ViewFactoryBuilder()
        );

        $classBuilder->setExtendClass(stdClass::class);

        $dummyPhpGenerator = new DummyPhpGenerator(
            $basePath,
            $baseNamespace,
            $classesConfig,
            $classBuilder,
        );

        $this->assertInstanceOf(PhpGeneratorInterface::class, $dummyPhpGenerator);

        $generated = $dummyPhpGenerator->generate();
        $this->assertTrue($generated);
        $this->assertFileEquals($basePath . '/Foo.php', __DIR__ . '/Resources/Foo.php');
    }
}
