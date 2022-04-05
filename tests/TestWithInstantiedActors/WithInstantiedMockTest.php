<?php

namespace SymfonyBoot\InjectMocks\Tests\TestWithInstantiedActors;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SymfonyBoot\InjectMocks\InjectMocks;
use SymfonyBoot\InjectMocks\Mock;
use SymfonyBoot\InjectMocks\MockInjector;
use SymfonyBoot\InjectMocks\Tests\TestWithInstantiedActors\Classes\Dependency;
use SymfonyBoot\InjectMocks\Tests\TestWithInstantiedActors\Classes\Service;

class WithInstantiedMockTest extends TestCase
{
    /** @Mock */
    private Dependency $dependency;
    /** @InjectMocks */
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
