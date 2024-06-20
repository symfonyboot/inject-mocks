<?php

namespace SilasYudi\InjectMocks\Tests\TestAnnotationInPrimitiveType;

use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\MockInjectException;
use SilasYudi\InjectMocks\MockInjector;

class InjectMocksAnnotationInPrimitiveTypeTest extends TestCase
{
    #[InjectMocks]
    private string $service;

    public function testWithoutInjectMocksType(): void
    {
        $this->expectException(MockInjectException::class);
        $this->expectExceptionMessage('Primitive type is not allowed for #Mock or #InjectMocks.');
        MockInjector::inject($this);
    }
}
