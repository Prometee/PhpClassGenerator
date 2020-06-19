<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;
use Prometee\PhpClassGenerator\View\Other\PropertiesViewInterface;

interface PropertiesViewFactoryInterface
{
    public function create(PropertiesInterface $properties): PropertiesViewInterface;
}
