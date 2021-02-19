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
    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        parent::__construct($id);
    }
}
