<?php

namespace Tests\Prometee\PhpClassGenerator;

use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use Prometee\PhpClassGenerator\Builder\ClassBuilder;
use Prometee\PhpClassGenerator\Builder\ClassBuilderInterface;
use Prometee\PhpClassGenerator\Builder\ModelFactoryBuilder;
use Prometee\PhpClassGenerator\Builder\ViewFactoryBuilder;
use Prometee\PhpClassGenerator\PhpGeneratorInterface;
use stdClass;

class PhpGeneratorTest extends TestCase
{
    /** @var string */
    private $basePath = __DIR__ . '/../etc/build/Dummy';
    /** @var string */
    private $baseNamespace = __NAMESPACE__ . '\\Resources';
    /** @var DummyPhpGenerator */
    private $dummyPhpGenerator;

    protected function setUp(): void
    {
        $classBuilder = new ClassBuilder(
            new ModelFactoryBuilder(),
            new ViewFactoryBuilder()
        );

        $this->dummyPhpGenerator = new DummyPhpGenerator(
            $this->basePath,
            $this->baseNamespace,
            [],
            $classBuilder,
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
                'extends' => null,
                'description' => [
                    'Array type test class',
                    '@internal',
                ],
                'properties' => [
                    [
                        'name' => 'anArrayOfItems',
                        'types' => [
                            $this->baseNamespace . '\\ArrayTest[]',
                            'null'
                        ],
                        'default' => null,
                        'description' => null
                    ],
                    [
                        'name' => 'aSimpleArrayField',
                        'types' => [
                            'array',
                            'null'
                        ],
                        'default' => null,
                        'description' => null
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals($this->basePath . '/ArrayTest.php', __DIR__ . '/Resources/ArrayTest.php');
    }

    public function testGenerateBooleanType(): void
    {
        $classesConfig = [
            [
                'class' => 'BooleanTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => null,
                'description' => [
                    'Boolean type test class',
                    '@internal',
                ],
                'properties' => [
                    [
                        'name' => 'aBoolField',
                        'types' => [
                        'bool'
                        ],
                        'default' => 'false',
                        'description' => null,
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals($this->basePath . '/BooleanTest.php', __DIR__ . '/Resources/BooleanTest.php');
    }

    public function testGenerateStringType(): void
    {
        $classesConfig = [
            [
                'class' => 'StringTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => null,
                'description' => [
                    'String type test class',
                    '@internal',
                ],
                'properties' => [
                    [
                        'name' => 'aStringField',
                        'types' => [
                            'string'
                        ],
                        'default' => '\'\'',
                        'description' => null,
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals($this->basePath . '/StringTest.php', __DIR__ . '/Resources/StringTest.php');
    }

    public function testGenerateFloatType(): void
    {
        $classesConfig = [
            [
                'class' => 'FloatTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => null,
                'description' => [
                    'Float type test class',
                    '@internal',
                ],
                'properties' => [
                    [
                        'name' => 'aFloatField',
                        'types' => [
                            'float'
                        ],
                        'default' => '.0',
                        'description' => null
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals($this->basePath . '/FloatTest.php', __DIR__ . '/Resources/FloatTest.php');
    }

    public function testGenerateIntegerType(): void
    {
        $classesConfig = [
            [
                'class' => 'IntegerTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => null,
                'description' => [
                    'Integer type test class',
                    '@internal',
                ],
                'properties' => [
                    [
                        'name' => 'anIntegerField',
                        'types' => [
                            'int'
                        ],
                        'default' => '0',
                        'description' => null
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals($this->basePath . '/IntegerTest.php', __DIR__ . '/Resources/IntegerTest.php');
    }

    public function testGenerateMixedType(): void
    {
        $classesConfig = [
            [
                'class' => 'MixedTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => null,
                'description' => [
                    'Mixed type test class',
                    '@internal',
                ],
                'properties' => [
                    [
                        'name' => 'aMixedField',
                        'types' => [
                            'mixed',
                            'null',
                        ],
                        'default' => null,
                        'description' => null
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals($this->basePath . '/MixedTest.php', __DIR__ . '/Resources/MixedTest.php');
    }

    public function testGeneratePhpBaseClassType(): void
    {
        $classesConfig = [
            [
                'class' => 'PhpBaseClassTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => null,
                'description' => [
                    'Php base class type test class',
                    '@internal',
                ],
                'properties' => [
                    [
                        'name' => 'aStdClassField',
                        'types' => [
                            stdClass::class,
                            'null',
                        ],
                        'default' => null,
                        'description' => null
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals($this->basePath . '/PhpBaseClassTest.php', __DIR__ . '/Resources/PhpBaseClassTest.php');
    }

    public function testGeneratePhpBaseInterfaceType(): void
    {
        $classesConfig = [
            [
                'class' => 'PhpBaseInterfaceTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => null,
                'description' => [
                    'Php base Interface type test class',
                    '@internal',
                ],
                'properties' => [
                    [
                        'name' => 'aDateTimeField',
                        'types' => [
                            DateTimeInterface::class,
                            'null',
                        ],
                        'default' => null,
                        'description' => null
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals($this->basePath . '/PhpBaseInterfaceTest.php', __DIR__ . '/Resources/PhpBaseInterfaceTest.php');
    }

    public function testGenerateExtends(): void
    {
        $classesConfig = [
            [
                'class' => 'ExtendsTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => stdClass::class,
                'description' => [
                    'Extends test class',
                    '@internal',
                ],
                'properties' => [],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals($this->basePath . '/ExtendsTest.php', __DIR__ . '/Resources/ExtendsTest.php');
    }

    public function testGenerateComplexWithSubPathType(): void
    {
        $classesConfig = [
            [
                'class' => 'SubPath\\SubClassTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => null,
                'description' => [
                    'Sub path test class',
                    '@internal',
                ],
                'properties' => [],
            ],
            [
                'class' => 'ConfigWithSubPathTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => null,
                'description' => [
                    'Config with sub class type test class',
                    '@internal',
                ],
                'properties' => [
                    [
                        'name' => 'aSubClassField',
                        'types' => [
                            $this->baseNamespace . '\\SubPath\\SubClassTest',
                        ],
                        'default' => null,
                        'description' => null
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals($this->basePath . '/ConfigWithSubPathTest.php', __DIR__ . '/Resources/ConfigWithSubPathTest.php');
        $this->assertFileEquals($this->basePath . '/SubPath/SubClassTest.php', __DIR__ . '/Resources/SubPath/SubClassTest.php');
    }

    public function testGenerateWithExtends(): void
    {
        $classesConfig = [
            [
                'class' => 'SubPath\\ExtendedClassTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_ABSTRACT,
                'extends' => null,
                'description' => [
                    'Sub path extended test class',
                    '@internal',
                ],
                'properties' => [
                    [
                        'name' => 'id',
                        'types' => [
                            'int',
                        ],
                        'default' => null,
                        'description' => [
                            'ID of this model',
                            'A second line'
                        ]
                    ]
                ],
            ],
            [
                'class' => 'WithExtendsTest',
                'type' => ClassBuilderInterface::CLASS_TYPE_FINAL,
                'extends' => $this->baseNamespace . '\\SubPath\\ExtendedClassTest',
                'description' => [
                    'With extends test class',
                    '@internal',
                ],
                'properties' => [
                    [
                        'name' => 'id',
                        'types' => [
                            'int',
                        ],
                        'default' => null,
                        'description' => null,
                        'inherited' => true,
                    ],
                ],
            ],
        ];

        $this->dummyPhpGenerator->setClassesConfig($classesConfig);

        $this->assertTrue($this->dummyPhpGenerator->generate());
        $this->assertFileEquals($this->basePath . '/WithExtendsTest.php', __DIR__ . '/Resources/WithExtendsTest.php');
        $this->assertFileEquals($this->basePath . '/SubPath/ExtendedClassTest.php', __DIR__ . '/Resources/SubPath/ExtendedClassTest.php');
    }
}
