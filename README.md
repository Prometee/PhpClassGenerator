[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-github-actions]][link-github-actions]
[![Quality Score][ico-code-quality]][link-code-quality]

## PHP8 class generator

This library generate PHP8 classes.

## Installation

Install using Composer :

```
$ composer require prometee/php-class-generator
```

## Usage

Create your `PhpGenerator`, an example can be found here :

[DummyPhpGenerator.php](tests/DummyPhpGenerator.php)

Then instantiate :

```php
$loader = require_once( __DIR__.'/vendor/autoload.php');

use Doctrine\Common\Annotations\Annotation\Required;
use Prometee\PhpClassGenerator\Builder\ClassBuilder;
use Prometee\PhpClassGenerator\Builder\Model\ModelFactoryBuilder;
use Prometee\PhpClassGenerator\Builder\View\ViewFactoryBuilder;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

// Create your own Php Generator
final class MyPhpGenerator implements PhpGeneratorInterface {
    use PhpGeneratorTrait;
}

$path = __DIR__ . '/etc/build/Dummy';
$namespace = 'Tests\\Prometee\\PhpClassGenerator\\Resources';
$classConfig = [
    [
        'class' => 'MyClass',
        'type' => 'final',
        'extends' => stdClass::class,
        'description' => [
            'My own class description',
            'with multiple lines',
        ],
        'properties' => [
            [
                'name' => 'myProperty',
                'types' => [
                    'null',
                    $namespace . '\\MyClass[]',
                ],
                'default' => null,
                'description' => null,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'My description',
                        'My description line 2',
                    ],
                    sprintf('\\%s()', Required::class) => [''] // An annotation
                ],
            ],
        ],
    ],
];

$dummyPhpGenerator = new MyPhpGenerator(
    new ClassBuilder(
        new ModelFactoryBuilder(),
        new ViewFactoryBuilder()
    )
);

// Configure the generator first
$dummyPhpGenerator->configure(
    $path,
    $namespace,
    $classConfig
);

// Then generate
$dummyPhpGenerator->generate();

```

## Results example

[tests/Resources](tests/Resources)


[ico-version]: https://img.shields.io/packagist/v/Prometee/php-class-generator.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-github-actions]: https://github.com/Prometee/PhpClassGenerator/workflows/Build/badge.svg
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Prometee/PhpClassGenerator.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/prometee/php-class-generator
[link-github-actions]: https://github.com/Prometee/PhpClassGenerator/actions?query=workflow%3A"Build"
[link-code-quality]: https://scrutinizer-ci.com/g/Prometee/PhpClassGenerator
