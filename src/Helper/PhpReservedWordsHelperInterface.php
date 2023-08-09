<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Helper;

interface PhpReservedWordsHelperInterface
{
    /**
     * @see https://www.php.net/manual/en/reserved.keywords.php
     * @see https://www.php.net/manual/en/reserved.other-reserved-words.php
     */
    public const RESERVED_WORDS = [
        '__halt_compiler',
        'abstract',
        'and',
        'array',
        'as',
        'break',
        'callable',
        'case',
        'catch',
        'class',
        'clone',
        'const',
        'continue',
        'declare',
        'default',
        'die',
        'do',
        'echo',
        'else',
        'elseif',
        'empty',
        'enddeclare',
        'endfor',
        'endforeach',
        'endif',
        'endswitch',
        'endwhile',
        'eval',
        'exit',
        'extends',
        'final',
        'fn', // as of PHP 7.4
        'for',
        'foreach',
        'function',
        'global',
        'goto',
        'if',
        'implements',
        'include',
        'include_once',
        'instanceof',
        'insteadof',
        'interface',
        'isset',
        'list',
        'match', //as of PHP 8.0
        'namespace',
        'new',
        'or',
        'print',
        'private',
        'protected',
        'public',
        'readonly', //as of PHP 8.1.0 readonly may be used as function name.
        'require',
        'require_once',
        'return',
        'static',
        'switch',
        'throw',
        'trait',
        'try',
        'unset',
        'use',
        'var',
        'while',
        'xor',

        // PHP 7
        'int',
        'float',
        'bool',
        'string',
        'true',
        'false',
        'null',
        'void',
        'iterable',
        'object',

        // PHP 8
        'mixed',
        'never',

        // Soft reserved words
        'resource',
        'mixed',
        'numeric',
    ];

    public function check(string $word): bool;
}
