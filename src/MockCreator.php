<?php

namespace SilasYudi\InjectMocks;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MockCreator
{

    private static TestCase $testCase;

    public static function init(TestCase $testCase)
    {
        self::$testCase = $testCase;
    }

    public static function createMock(string $className): MockObject
    {
        return self::$testCase->getMockBuilder($className)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
    }
}
