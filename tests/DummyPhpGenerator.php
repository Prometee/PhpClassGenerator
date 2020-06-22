<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator;

use Exception;
use Prometee\PhpClassGenerator\Builder\ClassBuilderInterface;
use Prometee\PhpClassGenerator\PhpGeneratorInterface;

final class DummyPhpGenerator implements PhpGeneratorInterface
{
    /** @var string */
    private $basePath;
    /** @var array */
    private $classesConfig;
    /** @var string */
    private $baseNamespace;
    /** @var ClassBuilderInterface */
    private $classBuilder;

    public function __construct(
        string $basePath,
        string $baseNamespace,
        array $classesConfig,
        ClassBuilderInterface $classBuilder
    ) {
        $this->basePath = $basePath;
        $this->baseNamespace = $baseNamespace;
        $this->classesConfig = $classesConfig;
        $this->classBuilder = $classBuilder;
    }

    /**
     * {@inheritDoc}
     *
     * @throws Exception
     */
    public function generate(
        ?string $indent = null,
        ?string $eol = null
    ): bool {
        $indent = $indent ?? $this->classBuilder->getIndent();
        $eol = $eol ?? $this->classBuilder->getEol();
        $this->classBuilder->setIndent($indent);
        $this->classBuilder->setEol($eol);
        $this->classBuilder->setClassType(ClassBuilderInterface::CLASS_TYPE_FINAL);
        $this->classBuilder->setExtendClass(\stdClass::class);

        foreach ($this->classesConfig as $className => $properties) {
            foreach ($properties as $propertyName => $property) {
                $this->classBuilder->addClassicProperty(
                    $propertyName,
                    $property['types'],
                    $property['defaultValue'],
                    $property['description']
                );
            }

            $classContent = $this->classBuilder->build(
                $this->baseNamespace,
                $className
            );

            $classFilePath = $this->basePath . '/' . $className . '.php';

            $written = $this->writeClass($classContent, $classFilePath);

            if (false === $written) {
                throw new Exception(sprintf('Unable to write the file %s !', $classFilePath));
            }
        }

        return true;
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
