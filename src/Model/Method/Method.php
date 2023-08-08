<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use LogicException;
use Prometee\PhpClassGenerator\Model\AbstractModel;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareTrait;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocAwareTrait;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

class Method extends AbstractModel implements MethodInterface
{
    use UsesAwareTrait;
    use PhpDocAwareTrait;

    protected string $scope = self::SCOPE_PUBLIC;
    protected string $name = '';
    /** @var string[] */
    protected array $returnTypes = [];
    protected bool $static = false;
    protected string $description = '';
    /** @var MethodParameterInterface[] */
    protected array $parameters = [];
    /** @var string[] */
    protected array $lines = [];
    protected string $lineIndentation = '    ';

    public function __construct(
        UsesInterface $uses,
        PhpDocInterface $phpDoc
    ) {
        $this->setUses($uses);
        $this->setPhpDoc($phpDoc);
    }

    public function configure(
        string $scope,
        string $name,
        array $returnTypes = [],
        bool $static = false,
        string $description = ''
    ): void {
        $this->setScope($scope);
        $this->setName($name);
        $this->setReturnTypes($returnTypes);
        $this->setStatic($static);
        $this->setDescription($description);
        $this->setParameters([]);
        $this->setLines([]);

        $this->phpDoc->configure();
    }

    public function getPhpDocReturnType(): string
    {
        $returnTypes = [];
        foreach ($this->returnTypes as $returnType) {
            $returnTypes[] = $this->uses->addRawUseOrReturnType($returnType);
        }

        return implode('|', $returnTypes);
    }

    public function getReturnTypes(): array
    {
        return $this->returnTypes;
    }

    public function getPhpTypeFromReturnTypes(): string
    {
        $returnTypes = [];
        foreach ($this->returnTypes as $returnType) {
            $returnTypes[] = $this->uses->addRawUseOrReturnType($returnType);
        }
        return self::getPhpType($returnTypes);
    }

    public function setReturnTypes(array $returnTypes): void
    {
        $this->returnTypes = [];
        foreach ($returnTypes as $returnType) {
            $this->addReturnType($returnType);
        }
    }

    public function addReturnType(string $returnType): void
    {
        if (false === $this->hasReturnType($returnType)) {
            $this->returnTypes[] = $returnType;
        }
    }

    public function hasReturnType(string $returnType): bool
    {
        return in_array($returnType, $this->returnTypes);
    }

    public function addParameter(MethodParameterInterface $methodParameter): void
    {
        if (!$this->hasParameter($methodParameter)) {
            $this->setParameter($methodParameter);
        }
    }

    public function hasParameter(MethodParameterInterface $methodParameter): bool
    {
        return isset($this->parameters[$methodParameter->getName()]);
    }

    public function setParameter(MethodParameterInterface $methodParameter): void
    {
        $this->parameters[$methodParameter->getName()] = $methodParameter;
    }

    public function addLine(string $line): void
    {
        $this->lines[] = $line;
    }

    public function addMultipleLines(string $lines, string $eol = "\n"): void
    {
        if ('' === $eol) {
            throw new LogicException('EOL cannot be empty !');
        }
        $explodedLines = explode($eol, $lines);

        foreach ($explodedLines as $line) {
            $this->addLine($line);
        }
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function setScope(string $scope): void
    {
        $this->scope = $scope;
    }

    public function isStatic(): bool
    {
        return $this->static;
    }

    public function setStatic(bool $static): void
    {
        $this->static = $static;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function getLines(): array
    {
        return $this->lines;
    }

    public function setLines(array $lines): void
    {
        $this->lines = $lines;
    }

    public function getPhpDoc(): PhpDocInterface
    {
        return $this->phpDoc;
    }

    public function setPhpDoc(PhpDocInterface $phpDoc): void
    {
        $this->phpDoc = $phpDoc;
    }

    public function getLineIndentation(): string
    {
        return $this->lineIndentation;
    }

    public function setLineIndentation(string $lineIndentation): void
    {
        $this->lineIndentation = $lineIndentation;
    }
}
