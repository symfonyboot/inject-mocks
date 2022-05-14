<?php

namespace SilasYudi\InjectMocks\Tests\TestWithoutConstructor;

use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\Mock;
use SilasYudi\InjectMocks\MockInjectException;
use SilasYudi\InjectMocks\MockInjector;
use SilasYudi\InjectMocks\Tests\TestWithoutConstructor\Classes\DependencyA;
use SilasYudi\InjectMocks\Tests\TestWithoutConstructor\Classes\DependencyB;
use SilasYudi\InjectMocks\Tests\TestWithoutConstructor\Classes\Service;

class WithoutConstructorTest extends TestCase
{
    /** @Mock */
    private DependencyA $dependencyA;
    /** @Mock */
    private DependencyB $dependencyB;
    /** @InjectMocks */
    private Service $service;

    public function testWithoutConstructorShouldThrowMockInjectException(): void
    {
        $this->expectException(MockInjectException::class);
        $this->expectExceptionMessage('Test subject must have a constructor.');
        MockInjector::inject($this);
    }
}
