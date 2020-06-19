<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator;

use Prometee\PhpClassGenerator\Builder\ClassBuilderInterface;
use Prometee\PhpClassGenerator\PhpGeneratorInterface;

final class DummyPhpGenerator implements PhpGeneratorInterface
{
    /** @var string */
    private $basePath;
    /** @var string */
    private $baseNamespace;
    /** @var ClassBuilderInterface */
    private $classBuilder;

    public function __construct(
        string $basePath,
        string $baseNamespace,
        ClassBuilderInterface $classBuilder
    ) {
        $this->basePath = $basePath;
        $this->baseNamespace = $baseNamespace;
        $this->classBuilder = $classBuilder;
    }

    public function generate(
        ?string $indent = null,
        ?string $eol = null
    ): bool {
        $indent = $indent ?? $this->classBuilder->getIndent();
        $eol = $eol ?? $this->classBuilder->getEol();
        $this->classBuilder->setIndent($indent);
        $this->classBuilder->setEol($eol);
        $this->classBuilder->setClassType(ClassBuilderInterface::CLASS_TYPE_FINAL);

        $className = 'Foo';
        $this->classBuilder->addProperty(
            'anArrayOfItems',
            [
                $this->baseNamespace.'\\'.$className.'[]',
                'null'
            ],
            null,
            'My array field description'."\n".'with line break'
        );

        $this->classBuilder->addProperty(
            'aBoolField',
            [
                'bool'
            ],
            'false',
            'My bool field description'
        );
        $this->classBuilder->setExtendClass(\stdClass::class);

        $classContent = $this->classBuilder->build(
            $this->baseNamespace,
            $className
        );

        $classFilePath = $this->basePath . '/' . $className . '.php';

        return $this->writeClass($classContent, $classFilePath);
    }

    public function writeClass(string $classContent, string $classFilePath): bool
    {
        if (null === $classContent) {
            return false;
        }

        if (false === is_dir($this->basePath)) {
            mkdir($this->basePath);
        }

        return file_put_contents($classFilePath, $classContent) !== false;
    }
}