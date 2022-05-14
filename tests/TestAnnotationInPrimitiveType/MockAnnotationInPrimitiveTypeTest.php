<?php

namespace SilasYudi\InjectMocks\Tests\TestAnnotationInPrimitiveType;

use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\Mock;
use SilasYudi\InjectMocks\MockInjectException;
use SilasYudi\InjectMocks\MockInjector;

class MockAnnotationInPrimitiveTypeTest extends TestCase
{
    /** @Mock */
    private string $dependency;

    public function testWithoutInjectMocksType(): void
    {
        $this->expectException(MockInjectException::class);
        $this->expectExceptionMessage('Primitive type is not allowed for @Mock or @InjectMocks.');
        MockInjector::inject($this);
    }
}
