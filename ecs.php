<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoUselessInheritdocFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/psr12.php');

    $ecsConfig->rules([
        BlankLineAfterOpeningTagFixer::class,
        PhpdocNoUselessInheritdocFixer::class,
        NoEmptyPhpdocFixer::class,
        NoExtraBlankLinesFixer::class
    ]);
};
