<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Property;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class PropertyModelFactory extends AbstractModelFactory implements PropertyModelFactoryInterface
{
    /** @var PhpDocModelFactoryInterface */
    protected $phpDocModelFactory;

    public function __construct(
        string $modelClass,
        PhpDocModelFactoryInterface $phpDocModelFactory
    ) {
        parent::__construct($modelClass);
        $this->phpDocModelFactory = $phpDocModelFactory;
    }

    public function create(UsesInterface $uses): PropertyInterface
    {
        return new $this->modelClass(
            $uses,
            $this->phpDocModelFactory->create()
        );
    }

    public function getPhpDocModelFactory(): PhpDocModelFactoryInterface
    {
        return $this->phpDocModelFactory;
    }
}
