<?php

namespace SymfonyBoot\InjectMocks\Tests\TestCombinationsOfAnnotations;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SymfonyBoot\InjectMocks\InjectMocks;
use SymfonyBoot\InjectMocks\Mock;
use SymfonyBoot\InjectMocks\MockInjector;
use SymfonyBoot\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\DependencyA;
use SymfonyBoot\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\DependencyB;
use SymfonyBoot\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\Service;

class WithoutMockAnnotationTest extends TestCase
{
    /** @Mock */
    private DependencyA $dependencyA;

    private DependencyB $dependencyB;
    /** @InjectMocks */
    private Service $service;

    public function testWithoutMockAnnotationShouldAutoCreateMockAndInjectOnlyInTestSubject(): void
    {
        MockInjector::inject($this);

        $this->assertInstanceOf(Service::class, $this->service);

        $this->assertInstanceOf(DependencyA::class, $this->dependencyA);
        $this->assertInstanceOf(MockObject::class, $this->dependencyA);
        $this->assertSame($this->dependencyA, $this->service->getDependencyA());

        if (isset($this->dependencyB)) {
            $this->fail('The dependency shouldn\'t be autowire.');
        }

        $this->assertInstanceOf(DependencyB::class, $this->service->getDependencyB());
        $this->assertInstanceOf(MockObject::class, $this->service->getDependencyB());
    }
}
