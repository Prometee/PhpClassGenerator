<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\ClassModel;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;

abstract class AbstractDecoratedClassModelFactory extends AbstractModelFactory implements ModelFactoryInterface
{
    /** @var ClassModelFactoryInterface */
    protected $decoratedClassModelFactory;

    public function __construct(
        string $modelClass,
        ClassModelFactoryInterface $decoratedClassModelFactory
    ) {
        parent::__construct($modelClass);
        $this->decoratedClassModelFactory = $decoratedClassModelFactory;
    }
}
