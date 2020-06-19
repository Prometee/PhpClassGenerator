<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Attribute;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Attribute\PropertyInterface;
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

    public function render(string $indent = null, string $eol = null): ?string
    {
        parent::render($indent, $eol);

        $this->configurePhpDoc();

        $phpDocView = $this->phpDocViewFactory->create($this->property->getPhpDoc());

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
    }
}
