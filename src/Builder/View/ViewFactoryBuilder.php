<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\View;

final class ViewFactoryBuilder implements ViewFactoryBuilderInterface
{
    use ClassViewFactoryTrait,
        MethodViewFactoryTrait,
        OthersViewFactoryTrait,
        PhpDocViewFactoryTrait,
        AttributeViewFactoryTrait,
        PropertyViewFactoryTrait;
}
