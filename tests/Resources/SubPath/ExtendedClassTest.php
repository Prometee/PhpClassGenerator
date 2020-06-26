<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources\SubPath;

/**
 * Sub path extended test class
 * @internal
 */
abstract class ExtendedClassTest
{
    /** @var int */
    protected $id;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
