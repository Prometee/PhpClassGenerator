<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Other;

use Prometee\PhpClassGenerator\Factory\View\Other\UseViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\UseInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

class UsesView extends AbstractArrayView implements UsesViewInterface
{
    public function __construct(
        protected UsesInterface $uses,
        protected UseViewFactoryInterface $useViewFactory
    ) {
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
     * @return UseInterface[]
     */
    protected function orderUseModels(): array
    {
        $useModels = $this->uses->getUseModels();
        ksort($useModels, SORT_STRING | SORT_FLAG_CASE);

        return $useModels;
    }

    protected function doRender(): ?string
    {
        $content = parent::doRender();

        if (empty($content)) {
            return $content;
        }

        return $content . $this->eol;
    }
}
