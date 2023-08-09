<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources\SubPath;

/**
 * Sub path extended test class
 *
 * @internal
 */
abstract class ExtendedClassTest
{
    protected ?string $aString = null;

    public function __construct(
        /**
         * ID of this model
         * A second line
         */
        protected int $id
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getAString(): ?string
    {
        return $this->aString;
    }

    public function setAString(?string $aString): void
    {
        $this->aString = $aString;
    }
}
