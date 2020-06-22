<?php

namespace Tests\Prometee\PhpClassGenerator;

use PHPUnit\Framework\TestCase;
use Prometee\PhpClassGenerator\Builder\ClassBuilder;
use Prometee\PhpClassGenerator\Builder\ModelFactoryBuilder;
use Prometee\PhpClassGenerator\Builder\ViewFactoryBuilder;
use Prometee\PhpClassGenerator\PhpGeneratorInterface;

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
            ],
        ];

        $dummyPhpGenerator = new DummyPhpGenerator(
            $basePath,
            $baseNamespace,
            $classesConfig,
            new ClassBuilder(
                new ModelFactoryBuilder(),
                new ViewFactoryBuilder()
            ),
        );

        $this->assertInstanceOf(PhpGeneratorInterface::class, $dummyPhpGenerator);

        $generated = $dummyPhpGenerator->generate();
        $this->assertTrue($generated);
        $this->assertFileEquals($basePath . '/Foo.php', __DIR__ . '/Resources/Foo.php');
    }
}
