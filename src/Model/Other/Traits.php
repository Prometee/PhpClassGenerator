<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Model\AbstractModel;

class Traits extends AbstractModel implements TraitsInterface
{
    use UsesAwareTrait;

    /** @var array<int, string> */
    protected array $traits = [];

    public function configure(array $traits = []): void
    {
        $this->traits = $traits;
    }

    public function addTrait(string $name, ?string $desiredAlias = null): void
    {
        if (!$this->hasTrait($name)) {
            $this->setTrait($name, $desiredAlias);
        }
    }

    public function hasTrait(string $class): bool
    {
        return false !== array_search($class, $this->traits);
    }

    public function setTrait(string $class, ?string $desiredAlias = null): void
    {
        $this->uses->addRawUse($class, $desiredAlias);
        $this->traits[] = $class;
    }

    public function getTraits(): array
    {
        return $this->traits;
    }

    public function setTraits(array $traits): void
    {
        $this->traits = $traits;
    }
}
