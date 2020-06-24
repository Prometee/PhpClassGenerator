<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Helper;

final class PhpReservedWordsHelper implements PhpReservedWordsHelperInterface
{
    public function check(string $word): bool
    {
        return in_array(strtolower($word), self::RESERVED_WORDS);
    }
}