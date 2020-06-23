<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use LogicException;
use Prometee\PhpClassGenerator\Model\AbstractModel;

class Use_ extends AbstractModel implements UseInterface
{
    /** @var string */
    protected $use;
    /** @var string */
    protected $namespace;
    /** @var string */
    protected $className;
    /** @var string */
    protected $internalName;
    /** @var string|null */
    protected $alias;
    /** @var bool */
    protected $muted = false;

    public function configure(string $use, ?string $desiredAlias = null): void
    {
        if (empty($use)) {
            throw new LogicException('Given argument $use should not be empty !');
        }

        $this->use = $use;
        $useParts = explode('\\', $this->use);
        $this->className = (string) array_pop($useParts);
        $this->namespace = implode('\\', $useParts);
        $this->configureAlias($desiredAlias ?? $this->className);
    }

    public function configureAlias(string $desiredAlias): void
    {
        $this->internalName = $desiredAlias;

        $this->alias = null;
        if ($this->className !== $this->internalName) {
            $this->alias = $this->internalName;
        }
    }

    public function markAsMuted(): void
    {
        if (null === $this->alias) {
            $this->muted = true;
        }
    }

    public function getUse(): string
    {
        if (null === $this->use) {
            throw new LogicException(
                'The use should not be null, use "$this->configure" method before calling this method !'
            );
        }

        return $this->use;
    }

    public function setUse(string $use): void
    {
        $this->use = $use;
    }

    public function getNamespace(): string
    {
        if (null === $this->namespace) {
            throw new LogicException(
                'The namespace should not be null, use "$this->configure" method before calling this method !'
            );
        }
        return $this->namespace;
    }

    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    public function getClassName(): string
    {
        if (null === $this->className) {
            throw new LogicException(
                'The class name should not be null, use "$this->configure" method before calling this method !'
            );
        }
        return $this->className;
    }

    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    public function getInternalName(): string
    {
        if (null === $this->internalName) {
            throw new LogicException(
                'The internal name should not be null, use "$this->configure" method before calling this method !'
            );
        }

        return $this->internalName;
    }

    public function setInternalName(string $internalName): void
    {
        $this->internalName = $internalName;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): void
    {
        $this->alias = $alias;
    }

    public function isMuted(): bool
    {
        return $this->muted;
    }

    public function setMuted(bool $muted): void
    {
        $this->muted = $muted;
    }
}
