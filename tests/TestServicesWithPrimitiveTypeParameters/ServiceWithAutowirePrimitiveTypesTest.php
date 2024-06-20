<?php

namespace SilasYudi\InjectMocks\Tests\TestServicesWithPrimitiveTypeParameters;

use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\MockInjectException;
use SilasYudi\InjectMocks\MockInjector;
use SilasYudi\InjectMocks\Tests\TestServicesWithPrimitiveTypeParameters\Classes\ServiceWithAutowirePrimitiveType;

class ServiceWithAutowirePrimitiveTypesTest extends TestCase
{
    #[InjectMocks]
    private ServiceWithAutowirePrimitiveType $service;

    public function testServiceWithAutowirePrimitiveTypesShouldThrowMockInjectException(): void
    {
        $this->expectException(MockInjectException::class);
        $this->expectExceptionMessage('Cannot autowire primitive type.');
        MockInjector::inject($this);
    }
}
