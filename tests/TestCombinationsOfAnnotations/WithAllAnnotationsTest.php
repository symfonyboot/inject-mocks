<?php

namespace SilasYudi\InjectMocks\Tests\TestCombinationsOfAnnotations;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\Mock;
use SilasYudi\InjectMocks\MockInjector;
use SilasYudi\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\DependencyA;
use SilasYudi\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\DependencyB;
use SilasYudi\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\Service;

class WithAllAnnotationsTest extends TestCase
{
    /** @Mock */
    private DependencyA $dependencyA;
    /** @Mock */
    private DependencyB $dependencyB;
    /** @InjectMocks */
    private Service $service;

    public function testWithAnnotationsShouldCreateRealInstanceForSubjectAndCreateMocksAndInjectInSubjectAndInTestCase(): void
    {
        MockInjector::inject($this);

        $this->assertInstanceOf(Service::class, $this->service);

        $this->assertInstanceOf(DependencyA::class, $this->dependencyA);
        $this->assertInstanceOf(MockObject::class, $this->dependencyA);
        $this->assertSame($this->dependencyA, $this->service->getDependencyA());

        $this->assertInstanceOf(DependencyB::class, $this->dependencyB);
        $this->assertInstanceOf(MockObject::class, $this->dependencyB);
        $this->assertSame($this->dependencyB, $this->service->getDependencyB());
    }
}
