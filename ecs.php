<?php

use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoUselessInheritdocFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import('vendor/symplify/easy-coding-standard/config/set/psr12.php');

    $services = $containerConfigurator->services();

    $services->set(BlankLineAfterOpeningTagFixer::class);
    $services->set(PhpdocNoUselessInheritdocFixer::class);
    $services->set(NoEmptyPhpdocFixer::class);
    $services->set(NoExtraBlankLinesFixer::class);
};
