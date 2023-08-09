<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

use Tests\Prometee\PhpClassGenerator\Resources\SubPath\ExtendedClassTest;

/**
 * With extends test class
 *
 * @internal
 */
final class WithExtendsTest extends ExtendedClassTest
{
    protected ?string $aString = null;

    public function __construct(int $id)
    {
        parent::__construct($id);
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
