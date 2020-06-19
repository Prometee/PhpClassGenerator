<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\PhpDoc;

trait PhpDocAwareTrait
{
    /** @var PhpDocInterface */
    protected $phpDoc;

    public function __construct(PhpDocInterface $phpDoc)
    {
        $this->phpDoc = $phpDoc;
    }

    public function getPhpDoc(): PhpDocInterface
    {
        return $this->phpDoc;
    }

    public function setPhpDoc(PhpDocInterface $phpDoc): void
    {
        $this->phpDoc = $phpDoc;
    }
}
