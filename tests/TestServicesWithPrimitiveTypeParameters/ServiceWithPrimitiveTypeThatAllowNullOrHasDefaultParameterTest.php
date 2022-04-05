<?php

namespace SymfonyBoot\InjectMocks\Tests\TestServicesWithPrimitiveTypeParameters;

use DateTime;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use stdClass;
use SymfonyBoot\InjectMocks\InjectMocks;
use SymfonyBoot\InjectMocks\MockInjector;
use SymfonyBoot\InjectMocks\Tests\TestServicesWithPrimitiveTypeParameters\Classes\Dependency;
use SymfonyBoot\InjectMocks\Tests\TestServicesWithPrimitiveTypeParameters\Classes\ServiceWithPrimitiveTypeThatAllowNullOrHasDefaultParameter;

class ServiceWithPrimitiveTypeThatAllowNullOrHasDefaultParameterTest extends TestCase
{
    /** @InjectMocks */
    private ServiceWithPrimitiveTypeThatAllowNullOrHasDefaultParameter $service;

    public function testServiceWithNotAutowiredPrimitiveTypeShouldUseDefaultParametersOrNull(): void
    {
        MockInjector::inject($this);

        $this->assertInstanceOf(ServiceWithPrimitiveTypeThatAllowNullOrHasDefaultParameter::class, $this->service);

        $this->assertInstanceOf(Dependency::class, $this->service->getNotAuwowired());
        $this->assertInstanceOf(MockObject::class, $this->service->getNotAuwowired());

        $this->assertInstanceOf(DateTime::class, $this->service->getDateTime());
        $this->assertInstanceOf(MockObject::class, $this->service->getDateTime());

        $this->assertInstanceOf(stdClass::class, $this->service->getStdClass());
        $this->assertInstanceOf(MockObject::class, $this->service->getStdClass());

        $this->assertNull($this->service->getAllowNull());
        $this->assertTrue($this->service->isBoolean());
        $this->assertSame(1, $this->service->getInteger());
        $this->assertSame(2.0, $this->service->getFloat());
        $this->assertSame([3], $this->service->getArray());
        $this->assertNull($this->service->getNullStdClass());
    }
}
