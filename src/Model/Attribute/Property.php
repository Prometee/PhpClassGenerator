<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Attribute;

use Prometee\PhpClassGenerator\Model\AbstractModel;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareTrait;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocAwareTrait;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

class Property extends AbstractModel implements PropertyInterface
{
    use UsesAwareTrait {
        UsesAwareTrait::__construct as private __constructUses;
    }
    use PhpDocAwareTrait {
        PhpDocAwareTrait::__construct as private __constructPhpDoc;
    }

    /** @var string */
    protected $scope = 'private';
    /** @var string */
    protected $name;
    /** @var string|null */
    protected $value;
    /** @var string */
    protected $description = '';
    /** @var string[] */
    protected $types;
    /** @var bool */
    protected $readable = true;
    /** @var bool */
    protected $writeable = true;
    /** @var bool */
    protected $required = false;
    /** @var bool */
    protected $inherited = false;

    public function __construct(
        UsesInterface $uses,
        PhpDocInterface $phpDoc
    ) {
        $this->__constructUses($uses);
        $this->__constructPhpDoc($phpDoc);
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
        return false !== array_search($type, $this->types);
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
        return self::getPhpType($this->types);
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
}
