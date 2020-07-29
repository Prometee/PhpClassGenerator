<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Class_;

use Prometee\PhpClassGenerator\Factory\View\Other\MethodsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\PropertiesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\TraitsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\UsesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\ClassInterface;
use Prometee\PhpClassGenerator\View\AbstractView;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocViewAwareTrait;

class ClassView extends AbstractView implements ClassViewInterface
{
    use PhpDocViewAwareTrait {
        PhpDocViewAwareTrait::__construct as private __constructPhpDocViewFactory;
    }

    /** @var ClassInterface */
    protected $classModel;
    /** @var UsesViewFactoryInterface */
    protected $usesViewFactory;
    /** @var TraitsViewFactoryInterface */
    protected $traitsViewFactory;
    /** @var PropertiesViewFactoryInterface */
    protected $propertiesViewFactory;
    /** @var MethodsViewFactoryInterface */
    protected $methodsViewFactory;

    public function __construct(
        ClassInterface $classModel,
        PhpDocViewFactoryInterface $phpDocViewFactory,
        UsesViewFactoryInterface $usesViewFactory,
        TraitsViewFactoryInterface $traitsViewFactory,
        PropertiesViewFactoryInterface $propertiesViewFactory,
        MethodsViewFactoryInterface $methodsViewFactory
    ) {
        $this->classModel = $classModel;
        $this->__constructPhpDocViewFactory($phpDocViewFactory);
        $this->usesViewFactory = $usesViewFactory;
        $this->traitsViewFactory = $traitsViewFactory;
        $this->propertiesViewFactory = $propertiesViewFactory;
        $this->methodsViewFactory = $methodsViewFactory;
    }

    protected function doRender(): ?string
    {
        $this->configurePhpDoc(
            $this->classModel->getPhpDoc(),
            $this->classModel->getUses()
        );

        $format = '<?php%1$s'
            . '%1$s'
            . 'declare(strict_types=1);%1$s'
            . '%1$s'
            . 'namespace %2$s;%1$s'
            . '%1$s'
            . '%3$s'
            . '%4$s'
            . '%5$s%1$s'
            . '{'
            . '%6$s'
            . '}%1$s'
        ;

        // Build before rendering uses to allow adding late references
        $body = $this->buildBody();
        $signature = $this->buildSignature();

        $phpDocView = $this->phpDocViewFactory->create($this->classModel->getPhpDoc());
        $usesView = $this->usesViewFactory->create($this->classModel->getUses());

        return sprintf(
            $format,
            $this->eol,
            $this->classModel->getNamespace(),
            $usesView->render($this->indent, $this->eol),
            $phpDocView->render($this->indent, $this->eol),
            $signature,
            $body
        );
    }

    public function buildSignature(): ?string
    {
        return sprintf(
            '%s %s%s%s',
            $this->classModel->getType(),
            $this->classModel->getClassName(),
            $this->buildExtends(),
            $this->buildImplements()
        );
    }

    public function buildExtends(): ?string
    {
        $extendClass = $this->classModel->getExtendClassName();
        if (null === $extendClass) {
            return null;
        }

        $extendClassName = $this->classModel->getUses()->getInternalName($extendClass);

        return sprintf(' extends %s', $extendClassName);
    }

    public function buildImplements(): ?string
    {
        $implements = [];
        foreach ($this->classModel->getImplements() as $implement) {
            $implement = $this->classModel->getUses()->getInternalName($implement);
            if (null !== $implement) {
                $implements[] = $implement;
            }
        }

        if (empty($implements)) {
            return null;
        }

        return sprintf(' implements %s', implode(', ', $implements));
    }

    public function buildBody(): string
    {
        $traitsView = $this->traitsViewFactory->create($this->classModel->getTraits());
        $propertiesView = $this->propertiesViewFactory->create($this->classModel->getProperties());
        $methodsView = $this->methodsViewFactory->create($this->classModel->getMethods());

        $body = sprintf(
            '%s%s%s',
            $traitsView->render($this->indent, $this->eol),
            $propertiesView->render($this->indent, $this->eol),
            $methodsView->render($this->indent, $this->eol)
        );

        if (empty($body)) {
            $body = $this->eol;
        }

        return $body;
    }
}
