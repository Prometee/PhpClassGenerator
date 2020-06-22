<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\ClassModel;

use Prometee\PhpClassGenerator\Model\AbstractModel;
use Prometee\PhpClassGenerator\Model\Other\MethodsInterface;
use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;
use Prometee\PhpClassGenerator\Model\Other\TraitsInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareTrait;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

class ClassModel extends AbstractModel implements ClassModelInterface
{
    use UsesAwareTrait {
        UsesAwareTrait::__construct as private __constructUses;
    }

    /** @var PropertiesInterface */
    protected $properties;
    /** @var MethodsInterface */
    protected $methods;
    /** @var TraitsInterface */
    protected $traits;

    /** @var string */
    protected $type = 'class';
    /** @var string */
    protected $namespace = '';
    /** @var string */
    protected $className = '';
    /** @var string|null */
    protected $extendClassName;
    /** @var array<int, string> */
    protected $implements = [];

    public function __construct(
        UsesInterface $uses,
        PropertiesInterface $properties,
        MethodsInterface $methods,
        TraitsInterface $traits
    ) {
        $this->__constructUses($uses);
        $this->properties = $properties;
        $this->methods = $methods;
        $this->traits = $traits;

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

        $this->uses->guessUse($extendClass);
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
            $this->uses->guessUse($implement);
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
