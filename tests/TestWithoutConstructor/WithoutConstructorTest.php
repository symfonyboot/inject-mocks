<?php

namespace SymfonyBoot\InjectMocks\Tests\TestWithoutConstructor;

use PHPUnit\Framework\TestCase;
use SymfonyBoot\InjectMocks\InjectMocks;
use SymfonyBoot\InjectMocks\Mock;
use SymfonyBoot\InjectMocks\MockInjectException;
use SymfonyBoot\InjectMocks\MockInjector;
use SymfonyBoot\InjectMocks\Tests\TestWithoutConstructor\Classes\DependencyA;
use SymfonyBoot\InjectMocks\Tests\TestWithoutConstructor\Classes\DependencyB;
use SymfonyBoot\InjectMocks\Tests\TestWithoutConstructor\Classes\Service;

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
