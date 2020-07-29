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
        PhpDocViewAwareTrait::__construct as private __constructPhpDocViewFactory;
        PhpDocViewAwareTrait::configurePhpDoc as private _configurePhpDoc;
    }

    /** @var PropertyInterface */
    protected $property;

    public function __construct(
        PropertyInterface $property,
        PhpDocViewFactoryInterface $phpDocViewFactory
    ) {
        $this->property = $property;
        $this->__constructPhpDocViewFactory($phpDocViewFactory);
    }

    protected function doRender(): ?string
    {
        if ($this->property->isInherited()) {
            return null;
        }

        $this->configurePhpDoc(
            $this->property->getPhpDoc(),
            $this->property->getUses()
        );

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

    public function configurePhpDoc(PhpDocInterface $phpDoc, UsesInterface $uses): void
    {
        $description = $this->property->getDescription();
        if (false === empty($description)) {
            $phpDoc->addDescriptionLine($description);
        }

        $type = $this->property->getPhpDocType();
        if (null !== $type) {
            $phpDoc->addVarLine($type);
        }

        $this->_configurePhpDoc($phpDoc, $uses);
    }
}
