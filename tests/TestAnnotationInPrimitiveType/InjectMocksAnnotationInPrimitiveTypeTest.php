<?php

namespace SymfonyBoot\InjectMocks\Tests\TestAnnotationInPrimitiveType;

use PHPUnit\Framework\TestCase;
use SymfonyBoot\InjectMocks\InjectMocks;
use SymfonyBoot\InjectMocks\MockInjectException;
use SymfonyBoot\InjectMocks\MockInjector;

class InjectMocksAnnotationInPrimitiveTypeTest extends TestCase
{
    /** @InjectMocks */
    private string $service;

    public function testWithoutInjectMocksType(): void
    {
        $this->expectException(MockInjectException::class);
        $this->expectExceptionMessage('Primitive type is not allowed for @Mock or @InjectMocks.');
        MockInjector::inject($this);
    }
}
