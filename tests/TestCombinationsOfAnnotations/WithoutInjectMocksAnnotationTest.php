<?php

namespace SymfonyBoot\InjectMocks\Tests\TestCombinationsOfAnnotations;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SymfonyBoot\InjectMocks\Mock;
use SymfonyBoot\InjectMocks\MockInjector;
use SymfonyBoot\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\DependencyA;
use SymfonyBoot\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\DependencyB;
use SymfonyBoot\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\Service;

class WithoutInjectMocksAnnotationTest extends TestCase
{
    /** @Mock */
    private DependencyA $dependencyA;

    private DependencyB $dependencyB;

    private Service $service;

    public function testWithoutInjectMocksAnnotationCreateMockAnnotationAndInjectInOnlyTestCase(): void
    {
        MockInjector::inject($this);

        $this->assertInstanceOf(DependencyA::class, $this->dependencyA);
        $this->assertInstanceOf(MockObject::class, $this->dependencyA);

        if (isset($this->service)) {
            $this->fail('The service shouldn\'t be autowire.');
        }

        if (isset($this->dependencyB)) {
            $this->fail('The dependency shouldn\'t be autowire.');
        }
    }
}
