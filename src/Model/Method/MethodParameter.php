<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Model\AbstractModel;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareTrait;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocAwareTrait;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

class MethodParameter extends AbstractModel implements MethodParameterInterface
{
    use UsesAwareTrait;
    use PhpDocAwareTrait;

    protected string $scope = '';
    /** @var string[] */
    protected array $types = [];
    protected string $name = '';
    protected ?string $value = null;
    protected bool $byReference = false;
    protected string $description = '';

    public function __construct(
        UsesInterface $uses,
        PhpDocInterface $phpDoc,
    ) {
        $this->setUses($uses);
        $this->setPhpDoc($phpDoc);
    }

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

    public function getScope(): string
    {
        return $this->scope;
    }

    public function hasScope(): bool
    {
        return '' !== $this->scope;
    }

    public function setScope(string $scope): void
    {
        $this->scope = $scope;
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

    public function getPhpName(): string
    {
        return '$' . $this->getName();
    }

    public function addType(string $type): void
    {
        if (false === $this->hasType($type)) {
            $this->uses->addRawUse($type);
            $this->types[] = $type;
        }
    }

    public function hasType(string $type): bool
    {
        return in_array($type, $this->types, true);
    }

    public function getPhpTypeFromTypes(): string
    {
        $type = self::getPhpType($this->types);

        return $this->uses->addRawUseOrReturnType($type);
    }

    public function getPhpDocType(): string
    {
        $types = [];
        foreach ($this->types as $type) {
            $types[] = $this->uses->addRawUseOrReturnType($type);
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
