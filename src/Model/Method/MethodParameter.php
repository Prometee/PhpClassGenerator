<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Model\AbstractModel;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareTrait;

class MethodParameter extends AbstractModel implements MethodParameterInterface
{
    use UsesAwareTrait;

    /** @var string[] */
    protected $types = [];
    /** @var string */
    protected $name;
    /** @var string|null */
    protected $value;
    /** @var bool */
    protected $byReference = false;
    /** @var string */
    protected $description = '';

    public function configure(
        array $types,
        string $name,
        ?string $value = null,
        bool $byReference = false,
        string $description = ''
    ): void {
        $this->setTypes($types);
        $this->setName($name);
        $this->setValue($value);
        $this->setByReference($byReference);
        $this->setDescription($description);
    }

    public function getPhpName(): string
    {
        return '$' . $this->getName();
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function setTypes(array $types): void
    {
        $this->types = [];
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    public function addType(string $type): void
    {
        if (false === $this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    public function hasType(string $type): bool
    {
        return false !== array_search($type, $this->types);
    }

    public function getPhpTypeFromTypes(): string
    {
        $type = self::getPhpType($this->types);
        $type = $this->uses->guessUseOrReturnType($type);

        return $type;
    }

    public function getPhpDocType(): string
    {
        $types = [];
        foreach ($this->types as $type) {
            $types[] = $this->uses->guessUseOrReturnType($type);
        }

        return implode('|', $types);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function isByReference(): bool
    {
        return $this->byReference;
    }

    public function setByReference(bool $byReference): void
    {
        $this->byReference = $byReference;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
