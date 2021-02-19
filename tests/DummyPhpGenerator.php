<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator;

use Prometee\PhpClassGenerator\PhpGeneratorInterface;
use Prometee\PhpClassGenerator\PhpGeneratorTrait;

final class DummyPhpGenerator implements PhpGeneratorInterface
{
    use PhpGeneratorTrait;
}
