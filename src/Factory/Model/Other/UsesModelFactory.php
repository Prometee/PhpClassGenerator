<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Other;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class UsesModelFactory extends AbstractModelFactory implements UsesModelFactoryInterface
{
    /** @var UseModelFactoryInterface */
    private $useModelFactory;

    public function __construct(
        string $modelClass,
        UseModelFactoryInterface $useModelFactory
    ) {
        parent::__construct($modelClass);
        $this->useModelFactory = $useModelFactory;
    }

    public function create(): UsesInterface
    {
        return new $this->modelClass(
            $this->useModelFactory
        );
    }
}
