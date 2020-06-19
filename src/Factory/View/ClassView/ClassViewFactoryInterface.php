<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\ClassView;

use Prometee\PhpClassGenerator\Model\ClassModel\ClassModelInterface;
use Prometee\PhpClassGenerator\View\ClassView\ClassViewInterface;

interface ClassViewFactoryInterface
{
    public function create(ClassModelInterface $classModel): ClassViewInterface;

    public function getClassViewClass(): string;

    public function setClassViewClass(string $classViewClass): void;
}
