<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Class_;

use Prometee\PhpClassGenerator\Model\AbstractModel;
use Prometee\PhpClassGenerator\Model\Other\MethodsInterface;
use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;
use Prometee\PhpClassGenerator\Model\Other\TraitsInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareTrait;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocAwareTrait;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

class Class_ extends AbstractModel implements ClassInterface
{
    use UsesAwareTrait;
    use PhpDocAwareTrait;

    protected string $type = 'class';
    protected string $namespace = '';
    protected string $className = '';
    protected ?string $extendClassName = null;
    /** @var array<int, string> */
    protected array $implements = [];

    public function __construct(
        UsesInterface $uses,
        PhpDocInterface $phpDoc,
        protected PropertiesInterface $properties,
        protected MethodsInterface $methods,
        protected TraitsInterface $traits
    ) {
        $this->setUses($uses);
        $this->setPhpDoc($phpDoc);

        $this->properties->setUses($this->uses);
        $this->methods->setUses($this->uses);
        $this->traits->setUses($this->uses);
    }

    public function configure(
        string $namespace,
        string $className,
        ?string $extendClass = null,
        array $implements = []
    ): void {
        // First configure the namespace related fields
        $this->setNamespace($namespace);
        $this->setClassName($className);
        $this->uses->configure($this->namespace, $this->className);
        $this->setExtendClass($extendClass);
        $this->setImplements($implements);

        $this->traits->configure();
        $this->properties->configure();
        $this->methods->configure();
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTraits(): TraitsInterface
    {
        return $this->traits;
    }

    public function setTraits(TraitsInterface $traits): void
    {
        $this->traits = $traits;
    }

    public function getExtendClassName(): ?string
    {
        return $this->extendClassName;
    }

    public function setExtendClassName(?string $extendClassName): void
    {
        $this->extendClassName = $extendClassName;
    }

    public function setExtendClass(?string $extendClass): void
    {
        if (null === $extendClass) {
            $this->extendClassName = null;
            return;
        }

        $this->uses->addRawUse($extendClass);
        $this->setExtendClassName($extendClass);
    }

    public function getImplements(): array
    {
        return $this->implements;
    }

    public function setImplements(array $implements): void
    {
        $internalImplements = [];
        foreach ($implements as $implement) {
            $this->uses->addRawUse($implement);
            $internalImplements[] = $implement;
        }
        $this->implements = $internalImplements;
    }

    public function getProperties(): PropertiesInterface
    {
        return $this->properties;
    }

    public function setProperties(PropertiesInterface $properties): void
    {
        $this->properties = $properties;
    }

    public function getMethods(): MethodsInterface
    {
        return $this->methods;
    }

    public function setMethods(MethodsInterface $methods): void
    {
        $this->methods = $methods;
    }
}
