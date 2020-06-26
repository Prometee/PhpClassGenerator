<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\PhpDoc;

use Prometee\PhpClassGenerator\Model\ModelInterface;

interface PhpDocInterface extends ModelInterface
{
    public const TYPE_DESCRIPTION = '';
    public const TYPE_VAR = 'var';
    public const TYPE_RETURN = 'return';
    public const TYPE_PARAM = 'param';
    public const TYPE_THROWS = 'throws';

    public const LINE_TYPE_ORDER = [
        self::TYPE_DESCRIPTION,
        self::TYPE_VAR,
        self::TYPE_PARAM,
        self::TYPE_RETURN,
        self::TYPE_THROWS,
    ];

    public function configure(array $lines = [], ?int $wrapOn = null): void;

    public function orderLines(callable $orderingCallable): void;

    public function hasSingleVarLine(): bool;

    public function addReturnLine(string $line): void;

    public function addThrowsLine(string $line): void;

    public function addLine(string $line, string $type = ''): void;

    public function addVarLine(string $line): void;

    public function addDescriptionLine(string $line): void;

    public function addParamLine(string $name, string $type = '', string $description = ''): void;

    /**
     * @return array<string, array<int, string>>
     */
    public function getLines(): array;

    /**
     * @param array<string, array<int, string>> $lines
     */
    public function setLines(array $lines): void;
}
