<?php

namespace Tests\Prometee\PhpClassGenerator;

use Prometee\PhpClassGenerator\Builder\ClassBuilder;
use Prometee\PhpClassGenerator\Builder\ModelFactoryBuilder;
use Prometee\PhpClassGenerator\Builder\ViewFactoryBuilder;
use Prometee\PhpClassGenerator\PhpGeneratorInterface;
use PHPUnit\Framework\TestCase;

class PhpGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $basePath = __DIR__ . '/../etc/build/Dummy';
        $dummyPhpGenerator = new DummyPhpGenerator(
            $basePath,
            'Tests\\Dummy',
            new ClassBuilder(
                new ModelFactoryBuilder(),
                new ViewFactoryBuilder()
            ),
        );

        $this->assertInstanceOf(PhpGeneratorInterface::class, $dummyPhpGenerator);

        $generated = $dummyPhpGenerator->generate();
        $this->assertTrue($generated);
        $this->assertFileEquals($basePath.'/Foo.php', __DIR__.'/Resources/Foo.php');
    }
}
