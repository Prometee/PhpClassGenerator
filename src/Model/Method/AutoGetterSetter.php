<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use LogicException;
use Prometee\PhpClassGenerator\Model\Attribute\PropertyInterface;

class AutoGetterSetter implements AutoGetterSetterInterface
{
    /** @var GetterSetterInterface[] */
    protected $autoGettersSettersAware;

    /**
     * @param GetterSetterInterface[] $autoGettersSettersAware
     */
    public function __construct(array $autoGettersSettersAware)
    {
        ksort($autoGettersSettersAware);
        $this->autoGettersSettersAware = $autoGettersSettersAware;
    }

    public function configure(PropertyInterface $property): GetterSetterInterface
    {
        foreach ($this->autoGettersSettersAware as $getterSetter) {
            if (true === $getterSetter->supports($property)) {
                $getterSetter->configure($property);
                return $getterSetter;
            }
        }

        throw new LogicException('Unable to found a supported getter/setter for this property !');
    }
}