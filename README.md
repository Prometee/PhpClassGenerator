[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-code-quality]][link-code-quality]

## PHP7 class generator

This library generate PHP7 classes.

## Installation

Install using Composer :

```
$ composer require prometee/php-class-generator
```

## Usage

Create your `PhpGenerator`, an example can be found here :

[](tests/DummyPhpGenerator.php)

Then instantiate :

```php
$loader = require_once( __DIR__.'/vendor/autoload.php');

use Tests\Prometee\PhpClassGenerator\DummyPhpGenerator;
use Prometee\PhpClassGenerator\Builder\ClassBuilder;
use Prometee\PhpClassGenerator\Builder\ModelFactoryBuilder;
use Prometee\PhpClassGenerator\Builder\ViewFactoryBuilder;

$basePath = __DIR__ . '/etc/build/Dummy';
$dummyPhpGenerator = new DummyPhpGenerator(
    $basePath,
    'Tests\\Dummy',
    new ClassBuilder(
        new ModelFactoryBuilder(),
        new ViewFactoryBuilder()
    ),
);

// Then generate
$dummyPhpGenerator->generate();

```

## Result example

[](tests/Resources/Foo.php)


[ico-version]: https://img.shields.io/packagist/v/Prometee/php-class-generator.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Prometee/PhpClassGenerator/master.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Prometee/PhpClassGenerator.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/prometee/php-class-generator
[link-travis]: https://travis-ci.org/Prometee/PhpClassGenerator
[link-scrutinizer]: https://scrutinizer-ci.com/g/Prometee/PhpClassGenerator/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Prometee/PhpClassGenerator
