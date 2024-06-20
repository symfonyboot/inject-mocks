<?php

namespace SilasYudi\InjectMocks\Tests\TestWithoutType;

use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\Mock;
use SilasYudi\InjectMocks\MockInjectException;
use SilasYudi\InjectMocks\MockInjector;
use SilasYudi\InjectMocks\Tests\TestWithoutType\Classes\Dependency;

class WithoutInjectMocksTypeTest extends TestCase
{
    #[Mock]
    private Dependency $dependency;
    #[InjectMocks]
    private $service;

    public function testWithoutInjectMocksType(): void
    {
        $this->expectException(MockInjectException::class);
        $this->expectExceptionMessage("The 'service' property must be typed.");
        MockInjector::inject($this);
    }
}
