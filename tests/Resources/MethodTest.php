<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * Method test class
 *
 * @internal
 */
final class MethodTest
{
    public function aMethod(bool $aBoolean, int &$byReference, mixed $aMixed, string $aString = ''): void
    {
        echo 'A method body';
    }
}
