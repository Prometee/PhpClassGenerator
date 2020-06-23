<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Method;

use Prometee\PhpClassGenerator\Model\Method\MethodParameterInterface;
use Prometee\PhpClassGenerator\View\AbstractView;

class MethodParameterView extends AbstractView implements MethodParameterViewInterface
{
    /** @var MethodParameterInterface */
    protected $methodParameter;

    public function __construct(MethodParameterInterface $methodParameter)
    {
        $this->methodParameter = $methodParameter;
    }

    protected function doRender(): ?string
    {
        $content = '';

        $phpType = $this->methodParameter->getPhpTypeFromTypes();
        $content .= !empty($phpType) ? $phpType . ' ' : '';
        $content .= $this->methodParameter->isByReference() ? '&' : '';
        $content .= $this->methodParameter->getPhpName();
        $content .= ($this->methodParameter->getValue() !== null) ? ' = ' . $this->methodParameter->getValue() : '';

        return $content;
    }
}
