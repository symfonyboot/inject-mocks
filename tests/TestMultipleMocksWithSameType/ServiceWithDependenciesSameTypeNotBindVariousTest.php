<?php

namespace SilasYudi\InjectMocks\Tests\TestMultipleMocksWithSameType;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\Mock;
use SilasYudi\InjectMocks\MockInjector;
use SilasYudi\InjectMocks\Tests\TestMultipleMocksWithSameType\Classes\Dependency;
use SilasYudi\InjectMocks\Tests\TestMultipleMocksWithSameType\Classes\Service;

class ServiceWithDependenciesSameTypeNotBindVariousTest extends TestCase
{
    /** @Mock */
    private Dependency $dependencyOne;
    /** @InjectMocks */
    private Service $service;

    public function testServiceWithDependenciesSameTypeNotBindVarious(): void
    {
        MockInjector::inject($this);

        $this->dependencyOne->method('getSomething')->willReturn(10);

        $this->assertSame($this->dependencyOne, $this->service->getDependencyOne());

        $this->assertInstanceOf(MockObject::class, $this->service->getDependencyTwo());
        $this->assertInstanceOf(Dependency::class, $this->service->getDependencyTwo());

        $this->assertInstanceOf(MockObject::class, $this->service->getDependencyThree());
        $this->assertInstanceOf(Dependency::class, $this->service->getDependencyThree());

        $this->assertNotSame($this->service->getDependencyOne(), $this->service->getDependencyTwo());
        $this->assertNotSame($this->service->getDependencyOne(), $this->service->getDependencyThree());
        $this->assertNotSame($this->service->getDependencyTwo(), $this->service->getDependencyThree());

        $this->assertEquals(10, $this->service->getDependencyOne()->getSomething());
        $this->assertEquals(0, $this->service->getDependencyTwo()->getSomething());
        $this->assertEquals(0, $this->service->getDependencyThree()->getSomething());
    }
}
