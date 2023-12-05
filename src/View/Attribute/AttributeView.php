<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Attribute;

use Prometee\PhpClassGenerator\Model\Attribute\AttributeInterface;
use Prometee\PhpClassGenerator\View\AbstractView;

class AttributeView extends AbstractView implements AttributeViewInterface
{
    protected string $lineStartIndent = '';

    public function __construct(
        protected AttributeInterface $attribute,
    ) {
    }

    protected function doRender(): ?string
    {
        $attributeLines = $this->buildLines();

        if (empty($attributeLines)) {
            return null;
        }

        if ($this->attribute->hasSingleLine()) {
            return sprintf('%1$s#[%3$s]%2$s', $this->lineStartIndent, $this->eol, $attributeLines[0]);
        }

        $lines = [];
        foreach ($attributeLines as $attributeLine) {
            $attributeLinePrefix = empty($attributeLine) ? '' : $this->lineStartIndent;
            $lines[] = sprintf('%s %s%s,', $this->lineStartIndent, $attributeLinePrefix, $attributeLine);
        }
        return sprintf('%1$s#[%2$s%3$s%2$s%1$s]%2$s', $this->lineStartIndent, $this->eol, implode($this->eol, $lines));
    }

    public function buildLines(): array
    {
        $this->orderLines();

        return $this->attribute->getLines();
    }

    public function orderLines(): void
    {
        $this->attribute->orderLines('strcmp');
    }

    public function getLineStartIndent(): string
    {
        return $this->lineStartIndent;
    }

    public function setLineStartIndent(string $lineStartIndent): void
    {
        $this->lineStartIndent = $lineStartIndent;
    }
}
