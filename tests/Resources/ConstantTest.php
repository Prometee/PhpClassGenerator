<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * Constant test class
 *
 * @internal
 */
final class ConstantTest
{
    /** @var string */
    public const A_CONSTANT = 'test_constant_value';

    public const A_CONSTANT_WITH_NULL_VALUE = null;
}
