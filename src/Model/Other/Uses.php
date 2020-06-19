<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use LogicException;
use Prometee\PhpClassGenerator\Model\AbstractModel;

class Uses extends AbstractModel implements UsesInterface
{
    /** @var array<string, string> */
    protected $uses = [];
    /** @var array<string, string> */
    private $internalUses = [];
    /** @var string */
    private $namespace = '';

    public function configure(string $namespace, array $uses = [], array $internalUses = []): void
    {
        $this->namespace = $namespace;
        $this->uses = $uses;
        $this->internalUses = $internalUses;
    }

    public function isUsable(string $str): bool
    {
        if (1 === preg_match('#\\\\#', $str)) {
            return true;
        }

        // Cases of all base classes like
        // \stdClass or \Exception
        if (class_exists($str)) {
            return true;
        }

        return false;
    }

    public function cleanUse(string $use): string
    {
        $cleanedUse = rtrim($use, '][');
        $cleanedUse = trim($cleanedUse, '\\');
        $cleanedUse = ltrim($cleanedUse, '?');
        return $cleanedUse;
    }

    public function guessUseOrReturnType(string $use): string
    {
        if (false === $this->isUsable($use)) {
            return $use;
        }

        $isArray = 1 === preg_match('#\[]$#', $use);
        $this->guessUse($use);
        return $this->getInternalUseName($use) . ($isArray ? '[]' : '');
    }

    public function guessUse(string $use, string $alias = ''): void
    {
        if (false === $this->isUsable($use)) {
            return;
        }

        $use = $this->cleanUse($use);

        if (true === $this->hasUse($use)) {
            return;
        }

        $useParts = explode('\\', $use);
        array_pop($useParts);
        $namespace = implode('\\', $useParts);

        if ($namespace === $this->namespace) {
            $this->processInternalUseName($use, $alias);
            return;
        }

        $this->addUse($use, $alias);
    }

    public function addUse(string $use, string $alias = ''): void
    {
        if (!$this->hasUse($use)) {
            $this->setUse($use, $alias);
        }
    }

    public function hasUse(string $use): bool
    {
        return isset($this->uses[$use]);
    }

    public function setUse(string $use, string $alias = ''): void
    {
        $use = $this->cleanUse($use);
        $this->processInternalUseName($use, $alias);
        $this->uses[$use] = $alias;
    }

    public function getUseAlias(string $use): ?string
    {
        $use = $this->cleanUse($use);
        if ($this->hasUse($use)) {
            return $this->uses[$use];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getUses(): array
    {
        return $this->uses;
    }

    /**
     * {@inheritDoc}
     */
    public function setUses(array $uses): void
    {
        $this->uses = $uses;
    }

    public function hasInternalUse(string $internalUseName): bool
    {
        return isset($this->internalUses[$internalUseName]);
    }

    public function getInternalUse(string $internalUseName): ?string
    {
        $internalUseName = $this->cleanUse($internalUseName);
        if ($this->hasInternalUse($internalUseName)) {
            return $this->internalUses[$internalUseName];
        }

        return null;
    }

    public function getInternalUseName(string $use): ?string
    {
        $use = $this->cleanUse($use);
        $internalUseName = array_search($use, $this->internalUses);

        if (false === $internalUseName) {
            return null;
        }

        return $internalUseName;
    }

    public function processInternalUseName(string $use, string $internalUseName = ''): void
    {
        $use = $this->cleanUse($use);
        $existingInternalUseName = $this->getInternalUseName($use);
        if (null !== $existingInternalUseName) {
            return;
        }

        if (empty($use)) {
            throw new LogicException('Given argument $use should not be empty !');
        }

        if (empty($internalUseName)) {
            $useParts = explode('\\', $use);
            $internalUseName = (string) end($useParts);
            // cast needed for PhpStan, the only way end() return false
            // is when $useParts is en empty array and the only way this array
            // could be empty is when $use is an empty string, so because of
            // the test above, this should never append
        }

        $uniqInternalUseName = $internalUseName;
        if ($this->hasInternalUse($uniqInternalUseName)) {
            $uniqInternalUseName .= 'Alias';
        }

        $i = 1;
        while ($this->hasInternalUse($uniqInternalUseName)) {
            $uniqInternalUseName = $internalUseName . ++$i;
        }

        if ($uniqInternalUseName !== $internalUseName) {
            $this->uses[$use] = $uniqInternalUseName;
        }

        $this->internalUses[$uniqInternalUseName] = $use;
    }
}
