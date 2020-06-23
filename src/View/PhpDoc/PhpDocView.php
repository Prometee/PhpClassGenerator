<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\PhpDoc;

use LogicException;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;
use Prometee\PhpClassGenerator\View\AbstractView;

class PhpDocView extends AbstractView implements PhpDocViewInterface
{
    /** @var PhpDocInterface */
    protected $phpDoc;

    /** @var int */
    protected $wrapOn;

    public function __construct(
        PhpDocInterface $phpDoc,
        int $wrapOn = self::DEFAULT_WRAP_ON
    ) {
        $this->phpDoc = $phpDoc;
        $this->wrapOn = $wrapOn;
    }

    /**
     * {@inheritDoc}
     *
     * @throws LogicException
     */
    protected function doRender(): ?string
    {
        $phpdocLines = $this->buildLines();

        if (empty($phpdocLines)) {
            return null;
        }

        if ($this->phpDoc->hasSingleVarLine()) {
            return sprintf('%1$s/** %3$s */%2$s', $this->indent, "\n", $phpdocLines[0]);
        }

        $lines = [];
        foreach ($phpdocLines as $phpdocLine) {
            $phpdocLinePrefix = empty($phpdocLine) ? '' : ' ';
            $lines[] = sprintf('%s *%s%s', $this->indent, $phpdocLinePrefix, $phpdocLine);
        }

        return sprintf('%1$s/**%2$s%3$s%2$s%1$s */%2$s', $this->indent, "\n", implode("\n", $lines));
    }

    public function buildLines(): array
    {
        $phpdocLines = [];
        $previousType = null;

        $this->orderLines();

        foreach ($this->phpDoc->getLines() as $type => $lines) {
            if ($previousType === null) {
                $previousType = $type;
            }
            if ($previousType !== $type) {
                $phpdocLines[] = '';
                $previousType = $type;
            }
            $phpdocLines = array_merge(
                $phpdocLines,
                $this->buildTypedLines($type, $lines)
            );
        }
        return $phpdocLines;
    }

    public function buildTypedLines(string $type, array $lines): array
    {
        $phpdocLines = [];
        $linePrefix = $this->buildTypedLinePrefix($type);

        foreach ($lines as $line) {
            $phpdocLines = array_merge(
                $phpdocLines,
                $this->buildLinesFromSingleLine($linePrefix, $line)
            );
        }

        return $phpdocLines;
    }

    public function buildTypedLinePrefix(string $type): string
    {
        if ($type === PhpDocInterface::TYPE_DESCRIPTION) {
            return '';
        }

        return sprintf('@%s ', $type);
    }

    public function buildLinesFromSingleLine(string $linePrefix, string $line): array
    {
        $lines = [];
        $linePrefixLength = strlen($linePrefix);
        $blankSubLinePrefix = str_repeat(' ', $linePrefixLength);
        $explodedLines = explode("\n", $line);

        foreach ($explodedLines as $i => $explodedLine) {
            $wrapOn = $this->getWrapOn();
            if ($i === 0) {
                $wrapOn -= $linePrefixLength;
            }

            $lines = array_merge(
                $lines,
                $this->wrapLines($explodedLine, $wrapOn)
            );
        }

        foreach ($lines as $i => $line) {
            $subLinePrefix = $i === 0 ? $linePrefix : $blankSubLinePrefix;
            $lines[$i] = $subLinePrefix . $line;
        }

        return $lines;
    }

    public function wrapLines(string $line, ?int $wrapOn = null): array
    {
        $wrapOn = $wrapOn ?? $this->getWrapOn();
        $lines = [];
        $currentLine = '';

        foreach (explode(' ', $line) as $word) {
            if (iconv_strlen($currentLine . ' ' . $word) > $wrapOn) {
                $lines[] = $currentLine;
                $currentLine = $word;
            } else {
                $currentLine .= (!empty($currentLine) ? ' ' : '') . $word;
            }
        }
        $lines[] = $currentLine;

        return $lines;
    }

    public function orderLines(): void
    {
        $this->phpDoc->orderLines(function ($k1, $k2) {
            $o1 = array_search($k1, PhpDocInterface::LINE_TYPE_ORDER);
            $o2 = array_search($k2, PhpDocInterface::LINE_TYPE_ORDER);

            return $o1 - $o2;
        });
    }

    public function setWrapOn(int $wrapOn): void
    {
        $this->wrapOn = $wrapOn;
    }

    public function getWrapOn(): int
    {
        return $this->wrapOn;
    }
}
