<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\PhpDoc;

interface PhpDocAwareInterface
{
    public function getPhpDoc(): PhpDocInterface;

    public function setPhpDoc(PhpDocInterface $phpDoc): void;
}
