<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Model\AbstractModel;
use Prometee\PhpClassGenerator\Model\Method\MethodInterface;

class Methods extends AbstractModel implements MethodsInterface
{
    use UsesAwareTrait;

    /** @var MethodInterface[] */
    protected $methods = [];

    public function configure(array $methods = []): void
    {
        $this->methods = $methods;
    }

    public function addMultipleMethod(array $methods): void
    {
        foreach ($methods as $methodGenerator) {
            $this->addMethod($methodGenerator);
        }
    }

    public function addMethod(MethodInterface $method): void
    {
        if (!$this->hasMethod($method->getName())) {
            $this->methods[$method->getName()] = $method;
        }
    }

    public function getMethodByName(string $name): ?MethodInterface
    {
        if ($this->hasMethod($name)) {
            return $this->methods[$name];
        }

        return null;
    }

    public function hasMethod(string $name): bool
    {
        return isset($this->methods[$name]);
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    public function setMethods(array $methods): void
    {
        $this->methods = $methods;
    }
}
