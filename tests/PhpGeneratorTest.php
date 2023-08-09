<?php

namespace Tests\Prometee\PhpClassGenerator;

use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use Prometee\PhpClassGenerator\Builder\ClassBuilder;
use Prometee\PhpClassGenerator\Builder\ClassBuilderInterface;
use Prometee\PhpClassGenerator\Builder\Model\ModelFactoryBuilder;
use Prometee\PhpClassGenerator\Builder\View\ViewFactoryBuilder;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;
use Prometee\PhpClassGenerator\PhpGeneratorInterface;
use stdClass;

class PhpGeneratorTest extends TestCase
{
    private string $path = __DIR__ . '/../etc/build/Dummy';
    private string $namespace = __NAMESPACE__ . '\\Resources';
    private DummyPhpGenerator $dummyPhpGenerator;

    protected function setUp(): void
    {
        $classBuilder = new ClassBuilder(
            new ModelFactoryBuilder(),
            new ViewFactoryBuilder()
        );

        $this->dummyPhpGenerator = new DummyPhpGenerator($classBuilder);
        $this->dummyPhpGenerator->configure(
            $this->path,
            $this->namespace
        );
    }

    public function testGenerate(): void
    {
        $this->assertInstanceOf(PhpGeneratorInterface::class, $this->dummyPhpGenerator);
    }

    public function testGenerateArrayType(): void
    {
        $classesConfig = [
            [
                'class' => 'ArrayTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Array type test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'anArrayOfItems',
                        'types' => [
                            $this->namespace . '\\ArrayTest[]',
                            'null'
                        ]
                    ],
                    [
                        'name' => 'aSimpleArrayField',
                        'types' => [
                            'array',
                            'null'
                        ]
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/ArrayTest.php', $this->path . '/ArrayTest.php');
    }

    public function testGenerateConstant(): void
    {
        $classesConfig = [
            [
                'class' => 'ConstantTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Constant test class'
                    ],
                    'internal' => [''],
                ],
                'constants' => [
                    [
                        'name' => 'A_CONSTANT',
                        'types' => [
                            'string'
                        ],
                        'default' => '\'test_constant_value\'',
                        'readable' => false,
                        'writable' => false,
                    ],
                    [
                        'name' => 'A_CONSTANT_WITH_NULL_VALUE',
                        'types' => [],
                        'readable' => false,
                        'writable' => false,
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/ConstantTest.php', $this->path . '/ConstantTest.php');
    }

    public function testGenerateProperty(): void
    {
        $classesConfig = [
            [
                'class' => 'PropertyTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Property test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'scope' => 'public',
                        'name' => 'aString',
                        'types' => [
                            'string'
                        ],
                        'default' => '\'test_property_value\'',
                        'description' => 'A string var'
                    ],
                    [
                        'name' => 'aSimpleArrayField',
                        'types' => [
                            'array'
                        ],
                        'default' => '[]',
                        'description' => 'A simple array var'
                    ],
                    [
                        'name' => 'aBoolean',
                        'types' => [
                            'bool'
                        ],
                        'description' => 'A boolean var'
                    ],
                    [
                        'name' => 'anotherBoolean',
                        'types' => [
                            'bool'
                        ],
                        'description' => 'Another boolean var'
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/PropertyTest.php', $this->path . '/PropertyTest.php');
    }

    public function testGenerateBooleanType(): void
    {
        $classesConfig = [
            [
                'class' => 'BooleanTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Boolean type test class',
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'aBoolField',
                        'types' => [
                            'bool'
                        ],
                        'default' => 'false',
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/BooleanTest.php', $this->path . '/BooleanTest.php');
    }

    public function testGenerateStringType(): void
    {
        $classesConfig = [
            [
                'class' => 'StringTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'String type test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'aStringField',
                        'types' => [
                            'string'
                        ],
                        'default' => '\'\'',
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/StringTest.php', $this->path . '/StringTest.php');
    }

    public function testGenerateFloatType(): void
    {
        $classesConfig = [
            [
                'class' => 'FloatTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Float type test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'aFloatField',
                        'types' => [
                            'float'
                        ],
                        'default' => '.0'
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/FloatTest.php', $this->path . '/FloatTest.php');
    }

    public function testGenerateIntegerType(): void
    {
        $classesConfig = [
            [
                'class' => 'IntegerTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Integer type test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'anIntegerField',
                        'types' => [
                            'int'
                        ],
                        'default' => '0'
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/IntegerTest.php', $this->path . '/IntegerTest.php');
    }

    public function testGenerateMixedType(): void
    {
        $classesConfig = [
            [
                'class' => 'MixedTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Mixed type test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'aMixedField',
                        'types' => [
                            'mixed',
                            'null',
                        ],
                    ],
                    [
                        'name' => 'anOtherMixedField',
                        'types' => [
                            'int',
                            'string',
                        ],
                    ],
                    [
                        'name' => 'anOtherMixedFieldWithNull',
                        'types' => [
                            'int',
                            'string',
                            'null',
                        ],
                    ],
                    [
                        'name' => 'anOtherMixedFieldWithArray',
                        'types' => [
                            'self[]',
                            'array',
                        ],
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/MixedTest.php', $this->path . '/MixedTest.php');
    }

    public function testGeneratePhpBaseClassType(): void
    {
        $classesConfig = [
            [
                'class' => 'PhpBaseClassTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Php base class type test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'aStdClassField',
                        'types' => [
                            stdClass::class,
                            'null',
                        ],
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/PhpBaseClassTest.php', $this->path . '/PhpBaseClassTest.php');
    }

    public function testGeneratePhpBaseInterfaceType(): void
    {
        $classesConfig = [
            [
                'class' => 'PhpBaseInterfaceTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Php base Interface type test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'aDateTimeField',
                        'types' => [
                            DateTimeInterface::class,
                            'null',
                        ],
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/PhpBaseInterfaceTest.php', $this->path . '/PhpBaseInterfaceTest.php');
    }

    public function testGenerateExtends(): void
    {
        $classesConfig = [
            [
                'class' => 'ExtendsTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => stdClass::class,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Extends test class'
                    ],
                    'internal' => [''],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/ExtendsTest.php', $this->path . '/ExtendsTest.php');
    }

    public function testGenerateComplexWithSubPathType(): void
    {
        $classesConfig = [
            [
                'class' => 'SubPath\\SubClassTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Sub path test class'
                    ],
                    'internal' => [''],
                ],
            ],
            [
                'class' => 'ConfigWithSubPathTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Config with sub class type test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'aSubClassField',
                        'types' => [
                            $this->namespace . '\\SubPath\\SubClassTest',
                        ],
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/ConfigWithSubPathTest.php', $this->path . '/ConfigWithSubPathTest.php');
        $this->assertFileEquals(__DIR__ . '/Resources/SubPath/SubClassTest.php', $this->path . '/SubPath/SubClassTest.php');
    }

    public function testGenerateWithExtends(): void
    {
        $classesConfig = [
            [
                'class' => 'SubPath\\ExtendedClassTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_ABSTRACT,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'Sub path extended test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'id',
                        'types' => [
                            'int',
                        ],
                        'description' => [
                            'ID of this model',
                            'A second line'
                        ]
                    ],
                    [
                        'name' => 'aString',
                        'types' => [
                            'string',
                            'null',
                        ],
                    ],
                ],
            ],
            [
                'class' => 'WithExtendsTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => $this->namespace . '\\SubPath\\ExtendedClassTest',
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'With extends test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'id',
                        'types' => [
                            'int',
                        ],
                        'inherited' => true,
                        'inherited_required' => true,
                    ],
                    [
                        'name' => 'aString',
                        'types' => [
                            'string',
                            'null',
                        ],
                        'scope' => 'protected' // @todo try to guess the scope of the property when analysing the parent class
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/WithExtendsTest.php', $this->path . '/WithExtendsTest.php');
        $this->assertFileEquals(__DIR__ . '/Resources/SubPath/ExtendedClassTest.php', $this->path . '/SubPath/ExtendedClassTest.php');
    }

    public function testGeneratePhpDoc(): void
    {
        $classesConfig = [
            [
                'class' => 'PhpDocTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'phpdoc' => [
                    PhpDocInterface::TYPE_DESCRIPTION => [
                        'PhpDoc test class'
                    ],
                    'internal' => [''],
                ],
                'properties' => [
                    [
                        'name' => 'id',
                        'types' => [
                            'int',
                        ],
                        'phpdoc' => [
                            PhpDocInterface::TYPE_DESCRIPTION => [
                                'ID of this model',
                                'A second line',
                                'A third line with % inside',
                            ],
                            '\\Doctrine\\Common\\Annotations\\Annotation\\Required()' => ['']
                        ]
                    ]
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals(__DIR__ . '/Resources/PhpDocTest.php', $this->path . '/PhpDocTest.php');
    }
}
