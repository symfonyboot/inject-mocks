<?php

namespace SilasYudi\InjectMocks;

use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MockCreator
{

    private static TestCase $testCase;

    public static function init(TestCase $testCase): void
    {
        self::$testCase = $testCase;
    }

    public static function createMock(string $className): MockObject
    {
        return (new MockBuilder(self::$testCase, $className))
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->getMock();
    }
}
