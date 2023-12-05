<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Attribute;

use Prometee\PhpClassGenerator\Model\Attribute\AttributeInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

trait AttributeViewAwareTrait
{
    public function configureAttribute(AttributeInterface $attribute, UsesInterface $uses): void
    {
        $lines = $attribute->getLines();
        $attribute->setLines([]);
        foreach ($lines as $line) {
            $newLine = $uses->detectAndReplaceUsesInText($line);
            $attribute->addLine($newLine);
        }
    }
}
