<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Property;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;
use Prometee\PhpClassGenerator\View\AbstractView;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocViewAwareTrait;

class PropertyView extends AbstractView implements PropertyViewInterface
{
    use PhpDocViewAwareTrait {
        PhpDocViewAwareTrait::configurePhpDoc as private _configurePhpDoc;
    }

    public function __construct(
        protected PropertyInterface $property,
        protected PhpDocViewFactoryInterface $phpDocViewFactory,
    ) {
    }

    protected function doRender(): ?string
    {
        if ($this->property->isInherited()) {
            return null;
        }

        if ($this->property->isPromoted()) {
            return null;
        }

        $this->configurePhpDoc(
            $this->property->getPhpDoc(),
            $this->property->getUses()
        );

        $phpDocView = $this->phpDocViewFactory->create($this->property->getPhpDoc());

        $value = '';
        $defaultValue = $this->property->getValue() ?? $this->property->getDefaultValueFromTypes();
        if (null !== $defaultValue) {
            $value = sprintf(' = %s', $defaultValue);
        }

        $phpType = $this->property->getPhpTypeFromTypes();
        $phpType = $phpType === '' ? '' : ' ' . $phpType;
        return sprintf(
            '%1$s%3$s%2$s%4$s%5$s %6$s%7$s;%1$s',
            $this->eol,
            $this->indent,
            $phpDocView->render($this->indent, $this->eol),
            $this->property->getScope(),
            $phpType,
            $this->property->getPhpName(),
            $value
        );
    }

    public function configurePhpDoc(PhpDocInterface $phpDoc, UsesInterface $uses): void
    {
        $description = $this->property->getDescription();
        if (false === empty($description)) {
            $phpDoc->addDescriptionLine($description);
        }

        $phpDocType = $this->property->getPhpDocType();
        if ($phpDoc::isTypedLineRequired($this->property->getPhpTypeFromTypes(), $phpDocType)) {
            /** @var string $phpDocType */
            $phpDoc->addVarLine($phpDocType);
        }

        $this->_configurePhpDoc($phpDoc, $uses);
    }
}
