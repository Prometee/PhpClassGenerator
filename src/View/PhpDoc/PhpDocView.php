<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\PhpDoc;

use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;
use Prometee\PhpClassGenerator\View\AbstractView;

class PhpDocView extends AbstractView implements PhpDocViewInterface
{
    protected string $lineStartIndent = '';

    public function __construct(
        protected PhpDocInterface $phpDoc,
        protected int $wrapOn = self::DEFAULT_WRAP_ON
    ) {
    }

    protected function doRender(): ?string
    {
        $phpdocLines = $this->buildLines();

        if (empty($phpdocLines)) {
            return null;
        }

        if ($this->phpDoc->hasSingleVarLine()) {
            return sprintf('%1$s/** %3$s */%2$s', $this->lineStartIndent, $this->eol, $phpdocLines[0]);
        }

        $lines = [];
        foreach ($phpdocLines as $phpdocLine) {
            $phpdocLinePrefix = empty($phpdocLine) ? '' : ' ';
            $lines[] = sprintf('%s *%s%s', $this->lineStartIndent, $phpdocLinePrefix, $phpdocLine);
        }
        return sprintf('%1$s/**%2$s%3$s%2$s%1$s */%2$s', $this->lineStartIndent, $this->eol, implode($this->eol, $lines));
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
            foreach ($this->buildTypedLines($type, $lines) as $buildTypedLine) {
                $phpdocLines[] = $buildTypedLine;
            }
        }
        return $phpdocLines;
    }

    public function buildTypedLines(string $type, array $lines): array
    {
        $phpdocLines = [];
        $linePrefix = $this->buildTypedLinePrefix($type);

        foreach ($lines as $line) {
            foreach ($this->buildLinesFromSingleLine($linePrefix, $line) as $linesFromSingleLine) {
                $phpdocLines[] = $linesFromSingleLine;
            }
        }

        return $phpdocLines;
    }

    public function buildTypedLinePrefix(string $type): string
    {
        if ($type === PhpDocInterface::TYPE_DESCRIPTION) {
            return '';
        }

        return sprintf('@%s', $type);
    }

    public function buildLinesFromSingleLine(string $linePrefix, string $line): array
    {
        $lines = [];
        $linePrefixLength = strlen($linePrefix);
        $blankSubLinePrefix = str_repeat(' ', $linePrefixLength);

        /** @var array $explodedLines */
        $explodedLines = explode($this->eol, $line);
        foreach ($explodedLines as $i => $explodedLine) {
            $wrapOn = $this->getWrapOn();
            if (0 === $i) {
                $wrapOn -= $linePrefixLength;
            }

            foreach ($this->wrapLines($explodedLine, $wrapOn) as $wrapLine) {
                $lines[] = $wrapLine;
            }
        }

        foreach ($lines as $i => $l) {
            $subLinePrefix = $i === 0 ? $linePrefix : $blankSubLinePrefix;
            $space = false === empty($linePrefix) && false === empty($l) ? ' ' : '';
            $lines[$i] = sprintf('%s%s%s', $subLinePrefix, $space, $l);
            if (trim($lines[$i]) === '') {
                $lines[$i] = '';
            }
        }

        return $lines;
    }

    public function wrapLines(string $line, ?int $wrapOn = null): array
    {
        $wrapOn = $wrapOn ?? $this->getWrapOn();
        $lines = [];
        $currentLine = '';

        $startSpaces = '';
        if (preg_match('#^( +)#', $line, $matches)) {
            $startSpaces = $matches[1];
        }

        foreach (explode(' ', $line) as $i => $word) {
            if ($i === 0) {
                $word = $startSpaces . $word;
            }
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
            $o1 = array_search($k1, PhpDocInterface::LINE_TYPE_ORDER, true);
            $o1 = $o1 === false ? count(PhpDocInterface::LINE_TYPE_ORDER) + 1 : $o1;
            $o2 = array_search($k2, PhpDocInterface::LINE_TYPE_ORDER, true);
            $o2 = $o2 === false ? count(PhpDocInterface::LINE_TYPE_ORDER) + 1 : $o2;

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

    public function getLineStartIndent(): string
    {
        return $this->lineStartIndent;
    }

    public function setLineStartIndent(string $lineStartIndent): void
    {
        $this->lineStartIndent = $lineStartIndent;
    }
}
