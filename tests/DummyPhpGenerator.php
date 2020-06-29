<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator;

use Exception;
use Prometee\PhpClassGenerator\Builder\ClassBuilderInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;
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
        $this->basePath = rtrim($basePath, '/') . '/';
        $this->baseNamespace = trim($baseNamespace, '\\');
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

        foreach ($this->classesConfig as $config) {
            $path = explode('\\', $config['class']);
            $className = (string) array_pop($path);
            $classNamespace = (string) implode('\\', $path);
            $classNamespace = $this->baseNamespace . '\\' . $classNamespace;
            $classNamespace = rtrim($classNamespace, '\\');

            $classPath = implode('/', $path);
            $classFilePath = rtrim($this->basePath . '/' . $classPath, '/') . '/' . $className . '.php';

            $this->classBuilder->setClassType($config['type'] ?? '');
            $this->classBuilder->setExtendClass($config['extends'] ?? null);
            $this->classBuilder->getClassModel()->getPhpDoc()->setLines(
                [PhpDocInterface::TYPE_DESCRIPTION => $config['description'] ?? []]
            );

            $constantsConfig = $config['constants'] ?? [];
            foreach ($constantsConfig as $constantConfig) {
                $description = $constantConfig['description'] ?? [];
                $description = implode($eol, $description);
                $constant = $this->classBuilder->createConstant(
                    $constantConfig['name'],
                    $constantConfig['types'] ?? [],
                    $constantConfig['default'] ?? null,
                    $description
                );

                $constant->setReadable($constantConfig['readable'] ?? false);
                $constant->setWriteable($constantConfig['writable'] ?? false);
                $constant->setInherited($constantConfig['inherited'] ?? false);

                $this->classBuilder->addProperty($constant);
            }

            $propertiesConfig = $config['properties'] ?? [];
            foreach ($propertiesConfig as $propertyConfig) {
                $description = $propertyConfig['description'] ?? [];
                $description = implode($eol, $description);
                $property = $this->classBuilder->createProperty(
                    $propertyConfig['name'],
                    $propertyConfig['types'] ?? [],
                    $propertyConfig['default'] ?? null,
                    $description
                );

                if ($this->classBuilder->getClassType() !== ClassBuilderInterface::CLASS_TYPE_FINAL) {
                    $property->setScope('protected');
                }

                $property->setReadable($propertyConfig['readable'] ?? true);
                $property->setWriteable($propertyConfig['writable'] ?? true);
                $property->setInherited($propertyConfig['inherited'] ?? false);

                $this->classBuilder->addProperty($property);
            }

            $classContent = $this->classBuilder->build($classNamespace, $className);

            if (null === $classContent) {
                continue;
            }

            $written = $this->writeClass($classContent, $classFilePath);

            if (false === $written) {
                throw new Exception(sprintf('Unable to write the file %s !', $classFilePath));
            }
        }

        return true;
    }

    public function writeClass(string $classContent, string $classFilePath): bool
    {
        $classPath = dirname($classFilePath);
        if (false === is_dir($classPath)) {
            mkdir($classPath, 0777, true);
        }

        return file_put_contents($classFilePath, $classContent) !== false;
    }

    public function setClassesConfig(array $classesConfig): void
    {
        $this->classesConfig = $classesConfig;
    }

    public function getClassesConfig(): array
    {
        return $this->classesConfig;
    }
}
