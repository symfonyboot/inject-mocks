<?php

namespace SilasYudi\InjectMocks\Tests\TestWithoutType;

use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\Mock;
use SilasYudi\InjectMocks\MockInjectException;
use SilasYudi\InjectMocks\MockInjector;
use SilasYudi\InjectMocks\Tests\TestWithoutType\Classes\Service;

class WithoutMockTypeTest extends TestCase
{
    #[Mock]
    private $dependency;
    #[InjectMocks]
    private Service $service;

    public function testWithoutMockType(): void
    {
        $this->expectException(MockInjectException::class);
        $this->expectExceptionMessage("The 'dependency' property must be typed.");
        MockInjector::inject($this);
    }
}
