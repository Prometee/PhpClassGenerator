<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\PhpDoc;

use Prometee\PhpClassGenerator\Model\AbstractModel;

class PhpDoc extends AbstractModel implements PhpDocInterface
{
    /** @var array<string, array<int, string>> */
    protected array $lines = [];

    public function configure(array $lines = []): void
    {
        $this->lines = $lines;
    }

    public function orderLines(callable $orderingCallable): void
    {
        uksort($this->lines, $orderingCallable);
    }

    public function addLine(string $line, string $type = ''): void
    {
        if (!isset($this->lines[$type])) {
            $this->lines[$type] = [];
        }

        $this->lines[$type][] = $line;
    }

    public function addDescriptionLine(string $line): void
    {
        $this->addLine($line, static::TYPE_DESCRIPTION);
    }

    public function addVarLine(string $line): void
    {
        $this->addLine($line, static::TYPE_VAR);
    }

    public function addParamLine(string $name, string $type = '', string $description = ''): void
    {
        if (false === empty($type)) {
            $type .= ' ';
        }

        if (false === empty($description)) {
            $description = ' ' . $description;
        }

        $line = sprintf('%s%s%s', $type, $name, $description);
        $this->addLine(
            $line,
            static::TYPE_PARAM
        );
    }

    public function addReturnLine(string $line): void
    {
        if (empty($line)) {
            return;
        }

        $this->addLine($line, static::TYPE_RETURN);
    }

    public function addThrowsLine(string $line): void
    {
        $this->addLine($line, static::TYPE_THROWS);
    }

    public function hasSingleVarLine(): bool
    {
        return isset($this->lines[static::TYPE_VAR])
            && count($this->lines) === 1
            && count($this->lines[static::TYPE_VAR]) === 1;
    }

    public function getLines(): array
    {
        return $this->lines;
    }

    public function setLines(array $lines): void
    {
        $this->lines = $lines;
    }

    public static function isTypedLineRequired(string $phpType, ?string $phpDocType, string $description = ''): bool
    {
        if ('' !== $description) {
            return true;
        }

        if (null === $phpDocType) {
            return false;
        }

        if ('' === $phpType) {
            return true;
        }

        if ('void' === $phpDocType) {
            return false;
        }

        if ($phpType === $phpDocType) {
            return false;
        }

        $phpDocTypes = explode('|', $phpDocType);
        sort($phpDocTypes);
        $phpTypeEnhanced = (string) preg_replace('#^\?#', 'null|', $phpType);
        $phpTypes = explode('|', $phpTypeEnhanced);
        sort($phpTypes);

        if ($phpDocTypes === $phpTypes) {
            return false;
        }

        return true;
    }
}
