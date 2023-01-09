<?php

namespace SilasYudi\InjectMocks;

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
        $hasParametersWithSameType = self::hasParametersWithSameType($parameters);
        $values = [];

        foreach ($parameters as $parameter) {
            $values[] = self::findMock($parameter, $mocks, $hasParametersWithSameType);
        }

        return $values;
    }

    /**
     * @param ReflectionParameter $parameter
     * @param TestActor[] $mocks
     * @param bool $hasMockableParametersWithSameType
     * @return mixed
     */
    private static function findMock(
        ReflectionParameter $parameter,
        array $mocks,
        bool $hasMockableParametersWithSameType
    ) {
        $type = $parameter->getType()->getName();

        foreach ($mocks as $mock) {
            if (
                $mock->getType() == $type
                && (!$hasMockableParametersWithSameType || $mock->getParameter() == $parameter->getName())
            ) {
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

    /**
     * @param ReflectionParameter[] $parameters
     * @return bool
     */
    private static function hasParametersWithSameType(array $parameters): bool
    {
        $mockableParameters = array_filter($parameters, function (ReflectionParameter $parameter) {
            return !$parameter->getType()->isBuiltin();
        });

        $mockableTypes = array_map(function (ReflectionParameter $parameter) {
            return $parameter->getType()->getName();
        }, $mockableParameters);

        return count($mockableTypes) !== count(array_unique($mockableTypes));
    }
}
