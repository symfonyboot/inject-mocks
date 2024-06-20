<?php

namespace SilasYudi\InjectMocks\Tests\TestWithInstantiedActors;

use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\MockInjector;
use SilasYudi\InjectMocks\Tests\TestWithInstantiedActors\Classes\Service;

class WithInstantiedInjectMocksTest extends TestCase
{
    #[InjectMocks]
    private Service $service;

    public function testWithInstantiedInjectMocksShouldOverrideThisInstance(): void
    {
        $this->service = $this->createMock(Service::class);
        $referenceToService = $this->service;
        $this->assertSame($referenceToService, $this->service);

        MockInjector::inject($this);

        $this->assertNotSame($referenceToService, $this->service);
    }
}
