<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Other;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

/** @property class-string<UsesInterface> $modelClass */
final class UsesModelFactory extends AbstractModelFactory implements UsesModelFactoryInterface
{
    /**
     * @param class-string<UsesInterface> $modelClass
     */
    public function __construct(
        string $modelClass,
        private UseModelFactoryInterface $useModelFactory
    ) {
        parent::__construct($modelClass);
    }

    public function create(): UsesInterface
    {
        return new $this->modelClass(
            $this->useModelFactory
        );
    }
}
