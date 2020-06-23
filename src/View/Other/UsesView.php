<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Other;

use Prometee\PhpClassGenerator\Factory\View\Other\UseViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\UseModelInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

class UsesView extends AbstractArrayView implements UsesViewInterface
{
    /** @var UsesInterface */
    protected $uses;
    /** @var UseViewFactoryInterface */
    protected $useViewFactory;

    public function __construct(
        UsesInterface $uses,
        UseViewFactoryInterface $useViewFactory
    ) {
        $this->uses = $uses;
        $this->useViewFactory = $useViewFactory;
    }

    public function getArrayToBuild(): array
    {
        $useModels = $this->orderUseModels();

        $views = [];
        foreach ($useModels as $useModel) {
            $views[] = $this->useViewFactory->create($useModel);
        }

        return $views;
    }

    /**
     * @return UseModelInterface[]
     */
    protected function orderUseModels(): array
    {
        $useModels = $this->uses->getUseModels();
        ksort($useModels, SORT_STRING | SORT_FLAG_CASE);

        return $useModels;
    }

    /**
     * {@inheritDoc}
     */
    protected function doRender(): ?string
    {
        $content = parent::doRender();

        if (empty($content)) {
            return $content;
        }

        return $content . $this->eol;
    }
}
