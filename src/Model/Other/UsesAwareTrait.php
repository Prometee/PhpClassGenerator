<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

trait UsesAwareTrait
{
    /** @var UsesInterface **/
    protected $uses;

    public function __construct(UsesInterface $uses)
    {
        $this->uses = $uses;
    }

    public function getUses(): UsesInterface
    {
        return $this->uses;
    }

    public function setUses(UsesInterface $uses): void
    {
        $this->uses = $uses;
    }
}
