<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Other;

use Prometee\PhpClassGenerator\Model\Other\UseInterface;
use Prometee\PhpClassGenerator\View\AbstractView;

class UseView extends AbstractView implements UseViewInterface
{
    /** @var UseInterface */
    protected $useModel;

    public function __construct(UseInterface $useModel)
    {
        $this->useModel = $useModel;
    }

    protected function doRender(): ?string
    {
        if ($this->useModel->isMuted()) {
            return null;
        }

        $alias = '';
        if (null !== $this->useModel->getAlias()) {
            $alias = sprintf(' as %s', $this->useModel->getAlias());
        }

        return sprintf(
            'use %s%s;%s',
            $this->useModel->getUse(),
            $alias,
            $this->eol
        );
    }
}
