<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Method;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodParameterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;
use Prometee\PhpClassGenerator\View\AbstractView;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocViewAwareTrait;

class MethodParameterView extends AbstractView implements MethodParameterViewInterface
{
    use PhpDocViewAwareTrait {
        PhpDocViewAwareTrait::configurePhpDoc as private _configurePhpDoc;
    }

    public function __construct(
        protected MethodParameterInterface $methodParameter,
        protected PhpDocViewFactoryInterface $phpDocViewFactory,
    ) {
    }

    protected function doRender(): ?string
    {
        $this->configurePhpDoc(
            $this->methodParameter->getPhpDoc(),
            $this->methodParameter->getUses()
        );

        $phpDocFactory = $this->phpDocViewFactory->create($this->methodParameter->getPhpDoc());
        $phpDocFactory->setLineStartIndent($this->indent . $this->indent);

        $content = '';

        $phpType = $this->methodParameter->getPhpTypeFromTypes();
        $scope = $this->methodParameter->getScope();

        if ($this->methodParameter->hasScope()) {
            $content .= $phpDocFactory->render($this->indent, $this->eol);
        }

        $content .= !empty($scope) ? $scope . ' ' : '';
        $content .= !empty($phpType) ? $phpType . ' ' : '';
        $content .= $this->methodParameter->isByReference() ? '&' : '';
        $content .= $this->methodParameter->getPhpName();
        $content .= ($this->methodParameter->getValue() !== null) ? ' = ' . $this->methodParameter->getValue() : '';

        return $content;
    }

    public function configurePhpDoc(PhpDocInterface $phpDoc, UsesInterface $uses): void
    {
        $description = $this->methodParameter->getDescription();
        if (false === empty($description)) {
            $phpDoc->addDescriptionLine($description);
        }

        $phpDocType = $this->methodParameter->getPhpDocType();
        if ($phpDoc::isTypedLineRequired($this->methodParameter->getPhpTypeFromTypes(), $phpDocType)) {
            $phpDoc->addVarLine($phpDocType);
        }

        $this->_configurePhpDoc($phpDoc, $uses);
    }
}
