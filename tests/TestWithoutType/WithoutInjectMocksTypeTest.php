<?php

namespace SymfonyBoot\InjectMocks\Tests\TestWithoutType;

use PHPUnit\Framework\TestCase;
use SymfonyBoot\InjectMocks\InjectMocks;
use SymfonyBoot\InjectMocks\Mock;
use SymfonyBoot\InjectMocks\MockInjectException;
use SymfonyBoot\InjectMocks\MockInjector;
use SymfonyBoot\InjectMocks\Tests\TestWithoutType\Classes\Dependency;

class WithoutInjectMocksTypeTest extends TestCase
{
    /** @Mock */
    private Dependency $dependency;
    /** @InjectMocks */
    private $service;

    public function testWithoutInjectMocksType(): void
    {
        $this->expectException(MockInjectException::class);
        $this->expectExceptionMessage("The 'service' property must be typed.");
        MockInjector::inject($this);
    }
}
