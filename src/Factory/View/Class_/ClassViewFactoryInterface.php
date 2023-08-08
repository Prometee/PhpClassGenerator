<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Class_;

use Prometee\PhpClassGenerator\Model\Class_\ClassInterface;
use Prometee\PhpClassGenerator\View\Class_\ClassViewInterface;

interface ClassViewFactoryInterface
{
    public function create(ClassInterface $classModel): ClassViewInterface;

    public function getClassViewClass(): string;

    /** @param class-string<ClassViewInterface> $classViewClass */
    public function setClassViewClass(string $classViewClass): void;
}
