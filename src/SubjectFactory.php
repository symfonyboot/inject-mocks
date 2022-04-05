<?php

namespace SymfonyBoot\InjectMocks;

use ReflectionClass;
use ReflectionMethod;
use ReflectionParameter;

class SubjectFactory
{

    /**
     * @param string $className
     * @param TestActor[] $mocks
     * @return object
     */
    public static function createWithConstructor(string $className, array $mocks): object
    {
        $class = new ReflectionClass($className);

        if (!$class->getConstructor()) {
            throw new MockInjectException('Test subject must have a constructor.');
        }

        $values = self::organizeValues($class->getConstructor(), $mocks);
        return $class->newInstanceArgs($values);
    }

    /**
     * @param ReflectionMethod $constructor
     * @param TestActor[] $mocks
     * @return array
     */
    private static function organizeValues(ReflectionMethod $constructor, array $mocks): array
    {
        $parameters = $constructor->getParameters();
        $values = [];

        foreach ($parameters as $parameter) {
            $values[] = self::findMock($parameter, $mocks);
        }

        return $values;
    }

    /**
     * @param ReflectionParameter $parameter
     * @param TestActor[] $mocks
     * @return mixed
     */
    private static function findMock(ReflectionParameter $parameter, array $mocks)
    {
        $type = $parameter->getType()->getName();

        foreach ($mocks as $mock) {
            if ($mock->getType() == $type) {
                return $mock->getInstance();
            }
        }

        if ($parameter->isOptional()) {
            return $parameter->getDefaultValue();
        }

        if ($parameter->getType()->allowsNull() || $parameter->allowsNull()) {
            return null;
        }

        if (!$parameter->getType()->isBuiltin()) {
            return MockCreator::createMock($parameter->getType()->getName());
        }

        throw new MockInjectException('Cannot autowire primitive type.');
    }
}
