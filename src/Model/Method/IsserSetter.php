<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Model\Attribute\PropertyInterface;

class IsserSetter extends GetterSetter implements IsserSetterInterface
{
    public function supports(PropertyInterface $propertyGenerator): bool
    {
        $type = $propertyGenerator->getPhpTypeFromTypes();

        if ($type === 'bool') {
            return true;
        }

        if ($type === '?bool') {
            return true;
        }

        return false;
    }

    public function configureGetter(string $indent = null): void
    {
        if (false === $this->property->isReadable()) {
            return;
        }

        $this->getterMethod->configure(
            MethodInterface::SCOPE_PUBLIC,
            $this->getMethodName(static::ISSER_PREFIX),
            $this->property->getTypes()
        );

        $this->getterMethod->addLine(
            sprintf('return $this->%s;', $this->property->getName())
        );
    }
}
