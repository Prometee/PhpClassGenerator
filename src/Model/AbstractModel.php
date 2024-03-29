<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model;

abstract class AbstractModel implements ModelInterface
{
    public static function getValueType(?string $value): ?string
    {
        if (null === $value) {
            return null;
        }

        if ($value === '[]') {
            return 'array';
        }

        if (preg_match('#^[\'"].*[\'"]$#', $value)) {
            return 'string';
        }

        return self::getValueNumericType($value);
    }

    public static function getValueNumericType(string $value): ?string
    {
        if (in_array($value, ['true', 'false'])) {
            return 'bool';
        }

        if (preg_match('#^[0-9]+$#', $value)) {
            return 'int';
        }

        if (preg_match('#^[0-9\.]+$#', $value)) {
            return 'float';
        }

        return null;
    }

    /**
     * @param string[] $types
     *
     */
    public static function getPhpType(array $types): string
    {
        if (in_array('mixed', $types)) {
            return 'mixed';
        }

        $phpTypes = [];
        $isNullable = false;
        foreach ($types as $type) {
            if (str_ends_with($type, '[]')) {
                $phpTypes[] = 'array';
                continue;
            }
            if ($type === 'null') {
                $isNullable = true;
                continue;
            }

            $phpTypes[] = $type;
        }

        $phpTypes = array_unique($phpTypes);

        if (1 === count($phpTypes)) {
            return sprintf(
                '%s%s',
                $isNullable ? '?' : '',
                implode('', $phpTypes)
            );
        }

        return sprintf(
            '%s%s',
            implode('|', $phpTypes),
            $isNullable ? '|null' : ''
        );
    }

    public static function getPhpDefaultValue(array $types): ?string
    {
        $defaultValue = null;

        if (in_array('null', $types, true)) {
            return 'null';
        }

        switch (self::getPhpType($types)) {
            case 'array':
                $defaultValue = '[]';
                break;
            case 'string':
                $defaultValue = '\'\'';
                break;
            case 'bool':
                $defaultValue = 'true';
                break;
            case 'int':
                $defaultValue = '0';
                break;
            case 'float':
                $defaultValue = '.0';
                break;
        }

        return $defaultValue;
    }
}
