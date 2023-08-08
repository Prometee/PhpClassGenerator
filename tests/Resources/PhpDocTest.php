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
    public function __construct(
        /**
         * ID of this model
         * A second line
         * A third line with % inside
         *
         * @Required()
         */
        private int $id
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
