<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Factory\Model\Other\UseModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\AbstractModel;

class Uses extends AbstractModel implements UsesInterface
{
    /** @var UseModelFactoryInterface */
    protected $useModelFactory;
    /** @var UseModelInterface[] */
    protected $useModels = [];
    /** @var string */
    private $namespace = '';
    /** @var string|null */
    private $className;

    public function __construct(UseModelFactoryInterface $useModelFactory)
    {
        $this->useModelFactory = $useModelFactory;
    }

    public function configure(
        string $namespace,
        ?string $className = null,
        array $uses = []
    ): void {
        $this->namespace = $namespace;
        $this->className = $className;
        $this->useModels = $uses;
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

        // Ex: \DateTimeInterface
        if (interface_exists($str)) {
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

    public function addRawUseOrReturnType(string $use): string
    {
        if (false === $this->isUsable($use)) {
            return $use;
        }

        $arraySuffix =
            1 === preg_match('#\[]$#', $use)
                ? '[]'
                : ''
        ;

        $this->addRawUse($use);

        return $this->getInternalName($use) . $arraySuffix;
    }

    public function addRawUse(string $use, ?string $desiredAlias = null): void
    {
        if (false === $this->isUsable($use)) {
            return;
        }

        $use = $this->cleanUse($use);

        if (true === $this->hasUse($use)) {
            return;
        }

        $useModel = $this->useModelFactory->create();
        $useModel->configure($use, $desiredAlias);
        $internalName = $this->processInternalName($useModel);

        if ($useModel->getAlias() !== $internalName) {
            $useModel->configureAlias($internalName);
        }

        if ($useModel->getNamespace() === $this->namespace) {
            $useModel->markAsMuted();
        }

        $this->addUse($useModel);
    }

    public function getInternalName(string $use): ?string
    {
        $useModel = $this->getUse($use);

        if (null === $useModel) {
            return null;
        }

        return $useModel->getInternalName();
    }

    protected function processInternalName(UseModelInterface $useModel): string
    {
        $uniqInternalName = $useModel->getInternalName();
        if ($uniqInternalName === $this->className) {
            $uniqInternalName .= 'Alias';
        }

        if ($this->hasInternalUse($uniqInternalName)) {
            $uniqInternalName .= 'Alias';
        }

        $i = 1;
        while ($this->hasInternalUse($uniqInternalName)) {
            $uniqInternalName = $useModel->getInternalName() . ++$i;
        }

        return $uniqInternalName;
    }

    public function addUse(UseModelInterface $useModel): void
    {
        if (false === $this->hasUse($useModel->getUse())) {
            $this->useModels[$useModel->getUse()] = $useModel;
        }
    }

    public function hasUse(string $use): bool
    {
        return isset($this->useModels[$use]);
    }

    public function getUse(string $use): ?UseModelInterface
    {
        $use = $this->cleanUse($use);
        if (false === $this->hasUse($use)) {
            return null;
        }

        return $this->useModels[$use];
    }

    /**
     * {@inheritDoc}
     */
    public function getUseModels(): array
    {
        return $this->useModels;
    }

    /**
     * {@inheritDoc}
     */
    public function setUseModels(array $useModels): void
    {
        $this->useModels = $useModels;
    }

    public function hasInternalUse(string $internalName): bool
    {
        foreach ($this->useModels as $useModel) {
            if ($internalName === $useModel->getInternalName()) {
                return true;
            }
        }

        return false;
    }
}
