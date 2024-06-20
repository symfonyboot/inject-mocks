<?php

namespace SilasYudi\InjectMocks\Tests\TestWithInstantiedActors;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\Mock;
use SilasYudi\InjectMocks\MockInjector;
use SilasYudi\InjectMocks\Tests\TestWithInstantiedActors\Classes\Dependency;
use SilasYudi\InjectMocks\Tests\TestWithInstantiedActors\Classes\Service;

class WithInstantiedMockTest extends TestCase
{
    #[Mock]
    private Dependency $dependency;
    #[InjectMocks]
    private Service $service;

    public function testWithInstantiedMockShouldUseThisInstance(): void
    {
        $this->dependency = $this->createMock(Dependency::class);
        MockInjector::inject($this);

        $this->assertInstanceOf(Dependency::class, $this->dependency);
        $this->assertInstanceOf(MockObject::class, $this->dependency);
        $this->assertSame($this->dependency, $this->service->getDependency());
    }

    public function testWithInstantiedMockWithRealObjectShouldUseThisInstance(): void
    {
        $this->dependency = new Dependency();
        MockInjector::inject($this);

        $this->assertInstanceOf(Dependency::class, $this->dependency);
        $this->assertNotInstanceOf(MockObject::class, $this->dependency);
        $this->assertSame($this->dependency, $this->service->getDependency());
    }
}
