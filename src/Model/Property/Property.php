<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Property;

use Prometee\PhpClassGenerator\Model\AbstractModel;
use Prometee\PhpClassGenerator\Model\Attribute\AttributeAwareTrait;
use Prometee\PhpClassGenerator\Model\Attribute\AttributeInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareTrait;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocAwareTrait;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

class Property extends AbstractModel implements PropertyInterface
{
    use UsesAwareTrait;
    use PhpDocAwareTrait;
    use AttributeAwareTrait;

    protected string $scope = 'private';
    protected string $name = '';
    protected ?string $value = null;
    protected string $description = '';
    /** @var string[] */
    protected array $types = [];
    protected bool $readable = true;
    protected bool $writeable = true;
    protected bool $promoted = false;
    protected bool $required = false;
    protected bool $inherited = false;
    protected bool $inherited_required = false;
    private ?int $inherited_position = null;

    public function __construct(
        UsesInterface $uses,
        PhpDocInterface $phpDoc,
        AttributeInterface $attribute,
    ) {
        $this->setUses($uses);
        $this->setPhpDoc($phpDoc);
        $this->setAttribute($attribute);
    }

    public function configure(
        string $name,
        array $types = [],
        ?string $value = null,
        string $description = ''
    ): void {
        $this->setName($name);
        $this->setTypes($types);
        $this->setValue($value);
        $this->setDescription($description);

        $this->phpDoc->configure();
    }

    public function getPhpName(): string
    {
        return sprintf('$%s', $this->name);
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
            $this->uses->addRawUse($type);
            $this->types[] = $type;
        }
    }

    public function hasType(string $type): bool
    {
        return in_array($type, $this->types, true);
    }

    public function getPhpDocType(): ?string
    {
        if (empty($this->types)) {
            return null;
        }

        $types = [];
        foreach ($this->types as $type) {
            $types[] = $this->uses->addRawUseOrReturnType($type);
        }

        return implode('|', $types);
    }

    public function getPhpTypeFromTypes(): string
    {
        $types = [];
        foreach ($this->types as $type) {
            $types[] = $this->uses->addRawUseOrReturnType($type);
        }

        return self::getPhpType($types);
    }

    public function getDefaultValueFromTypes(): ?string
    {
        return self::getPhpDefaultValue($this->types);
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function setScope(string $scope): void
    {
        $this->scope = $scope;
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function isReadable(): bool
    {
        return $this->readable;
    }

    public function setReadable(bool $readable): void
    {
        $this->readable = $readable;
    }

    public function isWriteable(): bool
    {
        return $this->writeable;
    }

    public function setWriteable(bool $writeable): void
    {
        $this->writeable = $writeable;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    public function isInherited(): bool
    {
        return $this->inherited;
    }

    public function setInherited(bool $inherited): void
    {
        $this->inherited = $inherited;
    }

    public function isInheritedRequired(): bool
    {
        return $this->inherited_required;
    }

    public function setInheritedRequired(bool $inherited_required): void
    {
        $this->inherited_required = $inherited_required;
    }

    public function isInheritedAndInheritedRequired(): bool
    {
        return $this->isInherited() && $this->isInheritedRequired();
    }

    public function setInheritedPosition(?int $inherited_position): void
    {
        $this->inherited_position = $inherited_position;
    }

    public function getInheritedPosition(): ?int
    {
        return $this->inherited_position;
    }

    public function isPromoted(): bool
    {
        if ($this->isInheritedAndInheritedRequired()) {
            return false;
        }

        if (in_array('null', $this->getTypes())) {
            return false;
        }

        if (null === $this->getValue()) {
            return true;
        }

        return $this->isRequired();
    }
}
