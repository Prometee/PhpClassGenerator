<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\Model;

final class ModelFactoryBuilder implements ModelFactoryBuilderInterface
{
    use PropertiesModelFactoryTrait,
        ClassesModelFactoryTrait,
        MethodsModelFactoryTrait,
        GetterSettersModelFactoryTrait,
        OthersModelFactoryTrait,
        PhpDocModelFactoryTrait;
}
