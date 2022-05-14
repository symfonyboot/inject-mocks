<?php

namespace SilasYudi\InjectMocks\Tests\TestCombinationsOfAnnotations;

use PHPUnit\Framework\TestCase;
use SilasYudi\InjectMocks\MockInjector;
use SilasYudi\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\DependencyA;
use SilasYudi\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\DependencyB;
use SilasYudi\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes\Service;

class WithoutAnyAnnotationTest extends TestCase
{

    private DependencyA $dependencyA;

    private DependencyB $dependencyB;

    private Service $service;

    public function testWithoutAnyAnnotationsShouldDoNothing(): void
    {
        MockInjector::inject($this);

        if (isset($this->service)) {
            $this->fail('The service shouldn\'t be autowire.');
        }

        if (isset($this->dependencyA)) {
            $this->fail('The dependency A shouldn\'t be autowire.');
        }

        if (isset($this->dependencyB)) {
            $this->fail('The dependency B shouldn\'t be autowire.');
        }

        $this->addToAssertionCount(1);
    }
}
