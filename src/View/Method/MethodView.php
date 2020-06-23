<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Method;

use Prometee\PhpClassGenerator\Factory\View\Method\MethodParameterViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\View\AbstractView;

class MethodView extends AbstractView implements MethodViewInterface
{
    /** @var MethodInterface */
    protected $method;
    /** @var PhpDocViewFactoryInterface */
    protected $phpDocViewFactory;
    /** @var MethodParameterViewFactoryInterface */
    protected $methodParameterView;

    public function __construct(
        MethodInterface $method,
        PhpDocViewFactoryInterface $phpDocViewFactory,
        MethodParameterViewFactoryInterface $methodParameterView
    ) {
        $this->method = $method;
        $this->phpDocViewFactory = $phpDocViewFactory;
        $this->methodParameterView = $methodParameterView;
    }

    /**
     * {@inheritDoc}
     */
    protected function doRender(): ?string
    {
        $this->configurePhpDoc();

        $phpDocFactory = $this->phpDocViewFactory->create($this->method->getPhpDoc());

        return sprintf(
            '%1$s%3$s%4$s%1$s%2$s{%1$s%5$s%2$s}%1$s',
            $this->eol,
            $this->indent,
            $phpDocFactory->render($this->indent, $this->eol),
            $this->buildMethodSignature($phpDocFactory->getWrapOn()),
            $this->buildMethodBody()
        );
    }

    public function configurePhpDoc(): void
    {
        $phpDoc = $this->method->getPhpDoc();
        $description = $this->method->getDescription();
        if (false === empty($description)) {
            $phpDoc->addDescriptionLine($description);
        }
        foreach ($this->method->getParameters() as $parameter) {
            $phpDoc->addParamLine($parameter->getPhpName(), $parameter->getPhpDocType(), $parameter->getDescription());
        }
        $returnTypes = $this->method->getReturnTypes();
        if (false === empty($returnTypes) && false === in_array('void', $returnTypes)) {
            $phpDoc->addReturnLine($this->method->getPhpDocReturnType());
        }
    }

    public function buildMethodBody(): string
    {
        $content = '';
        foreach ($this->method->getLines() as $line) {
            foreach (explode("\n", $line) as $innerLine) {
                $suffix = empty($innerLine) ? '' : $this->indent . $this->indent;
                $content .= sprintf('%s%s%s', $suffix, $innerLine, "\n");
            }
        }
        return $content;
    }

    public function buildMethodSignature(int $wrapOn): string
    {
        $static = ($this->method->isStatic()) ? ' static ' : '';

        // result example : "string $first,%1$sstring $second,%1$sstring $third"
        $methodParameters = $this->buildMethodParameters('%1$s');
        // 3 = length of $formatVar - 1 (see the method parameter, the line just below)
        // -1 because the first parameter don't have $formatVar
        $methodParametersLength = strlen($methodParameters) - 3 * (count($this->method->getParameters()) - 1);
        $parametersFutureFormat = '%s%s%s';
        $content = sprintf(
            '%s%s%s function %s(%s)%s',
            $this->indent,
            $this->method->getScope(),
            $static,
            $this->method->getName(),
            $parametersFutureFormat,
            $this->buildReturnType()
        );

        $parametersStart = '';
        $additionalIndentation = ' ';
        $parametersEnd = '';
        $contentLength = strlen($content) - strlen($parametersFutureFormat) + $methodParametersLength;
        if ($contentLength > $wrapOn) {
            // Make parameters go into multiline formation
            $additionalIndentation = $this->eol . $this->indent . $this->indent;
            $parametersStart = $additionalIndentation;
            $parametersEnd = "\n" . $this->indent;
        }

        return sprintf(
            $content,
            $parametersStart,
            sprintf($methodParameters, $additionalIndentation),
            $parametersEnd
        );
    }

    public function buildMethodParameters(string $formatVar = ' '): string
    {
        $parameters = [];

        foreach ($this->method->getParameters() as $methodParameter) {
            $methodParameterView = $this->methodParameterView->create($methodParameter);
            $parameters[] = $methodParameterView->render($this->indent, $this->eol);
        }

        return implode(sprintf(',%s', $formatVar), $parameters);
    }

    public function buildReturnType(): string
    {
        if (empty($this->method->getReturnTypes())) {
            return '';
        }

        if (in_array('mixed', $this->method->getReturnTypes())) {
            return '';
        }

        $phpReturnType = $this->method->getPhpTypeFromReturnTypes();
        $phpReturnType = $this->method->getUses()->addRawUseOrReturnType($phpReturnType);
        return sprintf(': %s', $phpReturnType);
    }
}
