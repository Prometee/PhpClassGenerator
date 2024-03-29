<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Factory\Model\Other\UseModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\AbstractModel;

class Uses extends AbstractModel implements UsesInterface
{
    /** @var UseInterface[] */
    protected array $useModels = [];
    private string $namespace = '';
    private ?string $className = null;

    public function __construct(protected UseModelFactoryInterface $useModelFactory)
    {
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
        return ltrim($cleanedUse, '?');
    }

    public function addRawUseOrReturnType(string $use): string
    {
        if (false === $this->isUsable($use)) {
            return $use;
        }

        $arraySuffix =
            str_ends_with($use, '[]')
                ? '[]'
                : ''
        ;

        $nullPrefix =
            str_starts_with($use, '?')
                ? '?'
                : ''
        ;

        $this->addRawUse($use);

        return $nullPrefix . $this->getInternalName($use) . $arraySuffix;
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

    protected function processInternalName(UseInterface $useModel): string
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

    public function addUse(UseInterface $useModel): void
    {
        if (false === $this->hasUse($useModel->getUse())) {
            $this->useModels[$useModel->getUse()] = $useModel;
        }
    }

    public function hasUse(string $use): bool
    {
        return isset($this->useModels[$use]);
    }

    public function getUse(string $use): ?UseInterface
    {
        $use = $this->cleanUse($use);
        if (false === $this->hasUse($use)) {
            return null;
        }

        return $this->useModels[$use];
    }

    public function getUseModels(): array
    {
        return $this->useModels;
    }

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

    public function detectAndReplaceUsesInText(string $text, string $prefix = ''): string
    {
        $pattern = sprintf('#%s(\\\[\\\a-z0-9_]+)#i', $prefix);
        if (preg_match_all($pattern, $text, $matches)) {
            foreach ($matches[1] as $class) {
                $className = $this->addRawUseOrReturnType($class);
                $text = (string) preg_replace($pattern, sprintf('%s%s', $prefix, $className), $text);
            }
        }

        return $text;
    }
}
