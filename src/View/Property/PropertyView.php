<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Property;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;
use Prometee\PhpClassGenerator\View\AbstractView;

class PropertyView extends AbstractView implements PropertyViewInterface
{
    /** @var PropertyInterface */
    protected $property;
    /** @var PhpDocViewFactoryInterface */
    protected $phpDocViewFactory;

    public function __construct(
        PropertyInterface $property,
        PhpDocViewFactoryInterface $phpDocViewFactory
    ) {
        $this->property = $property;
        $this->phpDocViewFactory = $phpDocViewFactory;
    }

    protected function doRender(): ?string
    {
        if ($this->property->isInherited()) {
            return null;
        }

        $this->configurePhpDoc();

        $phpDocView = $this->phpDocViewFactory->create($this->property->getPhpDoc());
        $phpDocView->setLineStartIndent($this->indent);

        $value = '';
        if (null !== $this->property->getValue()) {
            $value = sprintf(' = %s', $this->property->getValue());
        }

        $format = '%1$s%3$s%2$s%4$s %5$s%6$s;%1$s';

        return sprintf(
            $format,
            $this->eol,
            $this->indent,
            $phpDocView->render($this->indent, $this->eol),
            $this->property->getScope(),
            $this->property->getPhpName(),
            $value
        );
    }

    public function configurePhpDoc(): void
    {
        $phpDoc = $this->property->getPhpDoc();
        $description = $this->property->getDescription();
        if (false === empty($description)) {
            $phpDoc->addDescriptionLine($description);
        }

        $type = $this->property->getPhpDocType();
        if (null !== $type) {
            $phpDoc->addVarLine($type);
        }

        $typedLines = $phpDoc->getLines();
        $phpDoc->setLines([]);
        foreach ($typedLines as $type => $lines) {
            foreach ($lines as $line) {
                $newLine = $this->detectUses($line);
                $newType = $this->detectUses('@' . $type);
                $phpDoc->addLine($newLine, ltrim($newType, '@'));
            }
        }
    }

    protected function detectUses(string $line): string
    {
        $pattern = '#@(\\\[\\\a-z0-9_]+)#i';
        if (preg_match_all($pattern, $line, $matches)) {
            foreach ($matches[1] as $class) {
                $className = $this->property->getUses()->addRawUseOrReturnType($class);
                $line = (string) preg_replace($pattern, sprintf('@%s', $className), $line);
            }
        }

        return $line;
    }
}
