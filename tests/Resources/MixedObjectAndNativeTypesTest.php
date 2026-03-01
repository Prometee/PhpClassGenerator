<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

use stdClass;

final class MixedObjectAndNativeTypesTest
{
    public function __construct(private stdClass|false $aMixedObjectAndNativeTypesField)
    {
    }

    public function getAMixedObjectAndNativeTypesField(): stdClass|false
    {
        return $this->aMixedObjectAndNativeTypesField;
    }

    public function setAMixedObjectAndNativeTypesField(
        stdClass|false $aMixedObjectAndNativeTypesField
    ): void {
        $this->aMixedObjectAndNativeTypesField = $aMixedObjectAndNativeTypesField;
    }
}
