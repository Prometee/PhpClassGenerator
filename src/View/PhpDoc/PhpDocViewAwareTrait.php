<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\PhpDoc;

use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

trait PhpDocViewAwareTrait
{
    public function configurePhpDoc(PhpDocInterface $phpDoc, UsesInterface $uses): void
    {
        $typedLines = $phpDoc->getLines();
        $phpDoc->setLines([]);
        foreach ($typedLines as $type => $lines) {
            foreach ($lines as $line) {
                $newLine = $uses->detectAndReplaceUsesInText($line, '@');
                $newType = $uses->detectAndReplaceUsesInText($type);
                $phpDoc->addLine($newLine, $newType);
            }
        }
    }
}
