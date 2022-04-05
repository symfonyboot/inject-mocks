<?php

namespace SymfonyBoot\InjectMocks\Tests\TestAnnotationInPrimitiveType;

use PHPUnit\Framework\TestCase;
use SymfonyBoot\InjectMocks\Mock;
use SymfonyBoot\InjectMocks\MockInjectException;
use SymfonyBoot\InjectMocks\MockInjector;

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
