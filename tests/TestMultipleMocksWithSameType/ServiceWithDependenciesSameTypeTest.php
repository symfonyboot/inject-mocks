<?php

namespace SilasYudi\InjectMocks\Tests\TestMultipleMocksWithSameType;

use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\Mock;
use SilasYudi\InjectMocks\MockInjector;
use SilasYudi\InjectMocks\Tests\TestMultipleMocksWithSameType\Classes\Dependency;
use SilasYudi\InjectMocks\Tests\TestMultipleMocksWithSameType\Classes\Service;

class ServiceWithDependenciesSameTypeTest extends TestCase
{
    #[Mock]
    private Dependency $dependencyOne;
    #[Mock]
    private Dependency $dependencyTwo;
    #[Mock]
    private Dependency $dependencyThree;
    #[InjectMocks]
    private Service $service;

    public function testServiceWithDependenciesSameTypeTest(): void
    {
        MockInjector::inject($this);

        $this->dependencyOne->method('getSomething')->willReturn(10);
        $this->dependencyTwo->method('getSomething')->willReturn(20);
        $this->dependencyThree->method('getSomething')->willReturn(30);

        $this->assertSame($this->dependencyOne, $this->service->getDependencyOne());
        $this->assertSame($this->dependencyTwo, $this->service->getDependencyTwo());
        $this->assertSame($this->dependencyThree, $this->service->getDependencyThree());

        $this->assertNotSame($this->service->getDependencyOne(), $this->service->getDependencyTwo());
        $this->assertNotSame($this->service->getDependencyOne(), $this->service->getDependencyThree());
        $this->assertNotSame($this->service->getDependencyTwo(), $this->service->getDependencyThree());

        $this->assertEquals(10, $this->service->getDependencyOne()->getSomething());
        $this->assertEquals(20, $this->service->getDependencyTwo()->getSomething());
        $this->assertEquals(30, $this->service->getDependencyThree()->getSomething());
    }
}
