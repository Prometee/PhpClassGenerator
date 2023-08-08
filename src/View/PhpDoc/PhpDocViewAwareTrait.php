<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\PhpDoc;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

trait PhpDocViewAwareTrait
{
    protected PhpDocViewFactoryInterface $phpDocViewFactory;

    public function configurePhpDoc(PhpDocInterface $phpDoc, UsesInterface $uses): void
    {
        $typedLines = $phpDoc->getLines();
        $phpDoc->setLines([]);
        foreach ($typedLines as $type => $lines) {
            foreach ($lines as $line) {
                $newLine = $this::detectAndReplaceUsesInText($line, $uses);
                $newType = $this::detectAndReplaceUsesInText($type, $uses, '');
                $phpDoc->addLine($newLine, $newType);
            }
        }
    }

    protected static function detectAndReplaceUsesInText(
        string $text,
        UsesInterface $uses,
        string $prefix = '@'
    ): string {
        $pattern = sprintf('#%s(\\\[\\\a-z0-9_]+)#i', $prefix);
        if (preg_match_all($pattern, $text, $matches)) {
            foreach ($matches[1] as $class) {
                $className = $uses->addRawUseOrReturnType($class);
                $text = (string) preg_replace($pattern, sprintf('%s%s', $prefix, $className), $text);
            }
        }

        return $text;
    }

    public function getPhpDocViewFactory(): PhpDocViewFactoryInterface
    {
        return $this->phpDocViewFactory;
    }

    public function setPhpDocViewFactory(PhpDocViewFactoryInterface $phpDocViewFactory): void
    {
        $this->phpDocViewFactory = $phpDocViewFactory;
    }
}
