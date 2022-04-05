<?php

namespace SymfonyBoot\InjectMocks\Tests\TestWithoutType;

use PHPUnit\Framework\TestCase;
use SymfonyBoot\InjectMocks\InjectMocks;
use SymfonyBoot\InjectMocks\Mock;
use SymfonyBoot\InjectMocks\MockInjectException;
use SymfonyBoot\InjectMocks\MockInjector;
use SymfonyBoot\InjectMocks\Tests\TestWithoutType\Classes\Service;

class WithoutMockTypeTest extends TestCase
{
    /** @Mock */
    private $dependency;
    /** @InjectMocks */
    private Service $service;

    public function testWithoutMockType(): void
    {
        $this->expectException(MockInjectException::class);
        $this->expectExceptionMessage("The 'dependency' property must be typed.");
        MockInjector::inject($this);
    }
}
