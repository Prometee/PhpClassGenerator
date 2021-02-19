<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

use Doctrine\Common\Annotations\Annotation\Required;

/**
 * PhpDoc test class
 *
 * @internal
 */
final class PhpDocTest
{
    /**
     * ID of this model
     * A second line
     *
     * @var int
     *
     * @Required()
     */
    private $id;

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
