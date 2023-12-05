<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\Model;

use Prometee\PhpClassGenerator\Factory\Model\Attribute\AttributeModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Attribute\AttributeModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Attribute\Attribute;
use Prometee\PhpClassGenerator\Model\Attribute\AttributeInterface;

trait AttributeModelFactoryTrait
{
    private ?AttributeModelFactoryInterface $attributeModelFactory = null;

    /** @var class-string<AttributeModelFactoryInterface> */
    private string $attributeModelFactoryClass = AttributeModelFactory::class;

    /** @var class-string<AttributeInterface> */
    private string $attributeClass = Attribute::class;

    public function buildAttributeModelFactory(): AttributeModelFactoryInterface
    {
        if (null === $this->attributeModelFactory) {
            $this->attributeModelFactory = new $this->attributeModelFactoryClass(
                $this->attributeClass
            );
        }

        return $this->attributeModelFactory;
    }

    public function getAttributeModelFactoryClass(): string
    {
        return $this->attributeModelFactoryClass;
    }

    public function setAttributeModelFactoryClass(string $attributeModelFactoryClass): void
    {
        $this->attributeModelFactoryClass = $attributeModelFactoryClass;
    }

    public function getAttributeClass(): string
    {
        return $this->attributeClass;
    }

    public function setAttributeClass(string $attributeClass): void
    {
        $this->attributeClass = $attributeClass;
    }
}
