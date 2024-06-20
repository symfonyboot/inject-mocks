<?php

namespace SilasYudi\InjectMocks;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionProperty;
use SilasYudi\Optional\Optional;

class MockInjector
{
    private static TestCase $testCase;
    private static ReflectionClass $testClass;

    public static function inject(TestCase $testCase): void
    {
        MockCreator::init($testCase);
        MockInjector::init($testCase);
    }

    private static function init(TestCase $testCase): void
    {
        self::$testCase = $testCase;
        self::$testClass = new ReflectionClass($testCase);
        $testProperties = self::$testClass->getProperties();

        $mocks = self::getTestMocks($testProperties);
        $subject = self::processTestSubject($testProperties, $mocks);

        self::injectMocksInTestCase($mocks);

        if ($subject) {
            self::injectActorInTestCase($subject);
        }
    }

    /**
     * @param ReflectionProperty[] $properties
     * @return TestActor[]
     */
    private static function getTestMocks(array $properties): array
    {
        $mocks = [];

        foreach ($properties as $property) {
            $annotation = $property->getAttributes(Mock::class);

            if ($annotation) {
                $type = self::getTypeName($property);
                $instance = self::getInstanceOfMock($property);
                $mocks[] = new TestActor($property->getName(), $type, $instance);
            }
        }

        return $mocks;
    }

    /**
     * @param ReflectionProperty[] $properties
     * @param TestActor[] $mocks
     * @return TestActor|null
     */
    private static function processTestSubject(array $properties, array $mocks): ?TestActor
    {
        foreach ($properties as $property) {
            $annotation = $property->getAttributes(InjectMocks::class);

            if ($annotation) {
                $type = self::getTypeName($property);
                $instance = SubjectFactory::createWithConstructor($type, $mocks);
                return new TestActor($property->getName(), $type, $instance);
            }
        }

        return null;
    }

    private static function getTypeName(ReflectionProperty $property): string
    {
        $type = Optional::ofNullable($property->getType())
            ->orElseThrow(new MockInjectException("The '{$property->getName()}' property must be typed."));

        if ($type->isBuiltin()) {
            throw new MockInjectException('Primitive type is not allowed for #Mock or #InjectMocks.');
        }

        return $type->getName();
    }

    private static function propertyIsInitialized(ReflectionProperty $property): bool
    {
        $property->setAccessible(true);
        return $property->isInitialized(self::$testCase);
    }

    private static function getInstanceOfMock(ReflectionProperty $property)
    {
        return self::propertyIsInitialized($property)
            ? $property->getValue(self::$testCase)
            : MockCreator::createMock(self::getTypeName($property));
    }

    /**
     * @param TestActor[] $mocks
     */
    private static function injectMocksInTestCase(array $mocks): void
    {
        foreach ($mocks as $mock) {
            self::injectActorInTestCase($mock);
        }
    }

    private static function injectActorInTestCase(TestActor $subject): void
    {
        $property = self::$testClass->getProperty($subject->getParameter());
        $property->setAccessible(true);
        $property->setValue(self::$testCase, $subject->getInstance());
    }
}
