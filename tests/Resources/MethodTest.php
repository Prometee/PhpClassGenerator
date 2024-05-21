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
    /**
     * A description
     *
     * @param bool $aBoolean A boolean
     * @param int $byReference By reference
     * @param mixed $aMixed A mixed
     * @param string $aString A string with an empty string value
     */
    public function aMethod(bool $aBoolean, int &$byReference, mixed $aMixed, string $aString = ''): void
    {
        echo 'A method body';
    }
}
