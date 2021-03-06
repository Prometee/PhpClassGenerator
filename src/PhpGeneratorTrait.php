<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator;

use Prometee\PhpClassGenerator\Builder\ClassBuilderInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocAwareInterface;
use Webmozart\Assert\Assert;

trait PhpGeneratorTrait
{
    /** @var ClassBuilderInterface */
    protected $classBuilder;

    /** @var string|null */
    protected $path;

    /** @var array|null */
    protected $classesConfig;

    /** @var string|null */
    protected $namespace;

    public function __construct(
        ClassBuilderInterface $classBuilder
    ) {
        $this->classBuilder = $classBuilder;
    }

    public function configure(
        string $path,
        string $namespace,
        array $classesConfig = []
    ): void {
        $this->path = rtrim($path, '/') . '/';
        $this->namespace = trim($namespace, '\\');
        $this->classesConfig = $classesConfig;
    }

    protected function isConfigured(): bool
    {
        if (null === $this->path) {
            return false;
        }

        if (null === $this->namespace) {
            return false;
        }

        if (null === $this->classesConfig) {
            return false;
        }

        return true;
    }

    public function generate(?string $indent = null, ?string $eol = null): bool
    {
        if (false === $this->isConfigured()) {
            return false;
        }

        $indent = $indent ?? $this->classBuilder->getIndent();
        $eol = $eol ?? $this->classBuilder->getEol();
        $this->classBuilder->setIndent($indent);
        $this->classBuilder->setEol($eol);

        foreach ($this->classesConfig as $config) {
            $class = $config['class'] ?? '';
            Assert::notEmpty($class, 'The config attribute "class" should not be empty !');

            $path = explode('\\', $class);
            $className = (string) array_pop($path);
            $classNamespace = (string) implode('\\', $path);
            $classNamespace = $this->namespace . '\\' . $classNamespace;
            $classNamespace = rtrim($classNamespace, '\\');

            $classPath = implode('/', $path);
            $classFilePath = rtrim($this->path . '/' . $classPath, '/') . '/' . $className . '.php';

            $this->classBuilder->setClassType($config['type'] ?? '');
            $this->classBuilder->setExtendClass($config['extends'] ?? null);
            $this->classBuilder->setImplements($config['implements'] ?? []);

            $constantsConfig = $config['constants'] ?? [];
            $this->buildConstants($constantsConfig, $eol);

            $propertiesConfig = $config['properties'] ?? [];
            $this->buildProperties($propertiesConfig, $eol);

            $methodsConfig = $config['methods'] ?? [];
            $this->buildMethods($methodsConfig, $eol);

            $classModel = $this->classBuilder->buildClass($classNamespace, $className);
            $this->buildPhpDoc($config['phpdoc'] ?? [], $classModel);

            $classContent = $this->classBuilder->renderClass($classModel);
            $this->classBuilder->reset();

            if (null === $classContent) {
                continue;
            }

            $written = $this->writeClass($classContent, $classFilePath);
            Assert::notFalse($written, sprintf('Unable to write the file %s !', $classFilePath));
        }

        return true;
    }

    protected function buildConstants(array $constantsConfig, string $eol): void
    {
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

            $this->buildPhpDoc($constantsConfig['phpdoc'] ?? [], $constant);

            $this->classBuilder->addProperty($constant);
        }
    }

    protected function buildProperties(array $propertiesConfig, string $eol): void
    {
        foreach ($propertiesConfig as $propertyConfig) {
            $description = $propertyConfig['description'] ?? [];
            $description = implode($eol, $description);

            $default = $propertyConfig['default'] ?? null;
            Assert::nullOrString(
                $default,
                "default value should be a string or null (ex: '\"my_default\"', 'true', 'false', '10', null"
            );

            $property = $this->classBuilder->createProperty(
                $propertyConfig['name'],
                $propertyConfig['types'],
                $default,
                $description
            );

            if ($this->classBuilder->getClassType() !== ClassBuilderInterface::CLASS_TYPE_FINAL) {
                $property->setScope(MethodInterface::SCOPE_PROTECTED);
            }

            $property->setReadable($propertyConfig['readable'] ?? true);
            $property->setWriteable($propertyConfig['writable'] ?? true);
            $property->setInherited($propertyConfig['inherited'] ?? false);
            $property->setInheritedPosition($propertyConfig['inherited_position'] ?? null);
            $property->setInheritedRequired($propertyConfig['inherited_required'] ?? false);

            $this->buildPhpDoc($propertyConfig['phpdoc'] ?? [], $property);

            $this->classBuilder->addProperty($property);
        }
    }

    protected function buildMethods(array $methodsConfig, string $eol): void
    {
        foreach ($methodsConfig as $methodConfig) {
            $method = $this->classBuilder->createMethod(
                $methodConfig['scope'] ?? MethodInterface::SCOPE_PUBLIC,
                $methodConfig['name'],
                $methodConfig['return_types'] ?? [],
                $methodConfig['static'] ?? false,
            );

            /** @var string[] $body */
            $body = $methodConfig['body'];
            $method->addMultipleLines(implode($eol, $body), $eol);

            $this->buildPhpDoc($methodsConfig['phpdoc'] ?? [], $method);

            $this->classBuilder->addMethod($method);
        }
    }

    protected function buildPhpDoc(array $phpdoc, PhpDocAwareInterface $phpDocAware): void
    {
        foreach ($phpdoc as $type => $lines) {
            foreach ($lines as $line) {
                $phpDocAware->getPhpDoc()->addLine($line, $type);
            }
        }
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

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    public function getClassBuilder(): ClassBuilderInterface
    {
        return $this->classBuilder;
    }

    public function setClassBuilder(ClassBuilderInterface $classBuilder): void
    {
        $this->classBuilder = $classBuilder;
    }
}
