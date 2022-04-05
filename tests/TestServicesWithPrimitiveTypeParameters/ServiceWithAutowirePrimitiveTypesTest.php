<?php

namespace SymfonyBoot\InjectMocks\Tests\TestServicesWithPrimitiveTypeParameters;

use PHPUnit\Framework\TestCase;
use SymfonyBoot\InjectMocks\InjectMocks;
use SymfonyBoot\InjectMocks\MockInjectException;
use SymfonyBoot\InjectMocks\MockInjector;
use SymfonyBoot\InjectMocks\Tests\TestServicesWithPrimitiveTypeParameters\Classes\ServiceWithAutowirePrimitiveType;

class ServiceWithAutowirePrimitiveTypesTest extends TestCase
{
    /** @InjectMocks */
    private ServiceWithAutowirePrimitiveType $service;

    public function testServiceWithAutowirePrimitiveTypesShouldThrowMockInjectException(): void
    {
        $this->expectException(MockInjectException::class);
        $this->expectExceptionMessage('Cannot autowire primitive type.');
        MockInjector::inject($this);
    }
}
