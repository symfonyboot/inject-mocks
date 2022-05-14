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

class WithMultipleInjectMockAnnotationTest extends TestCase
{
    /** @InjectMocks */
    private Service $service;
    /** @InjectMocks */
    private DependencyA $otherService;

    public function testWithMultipleInjectMocksAnnotationShouldUseFirstOne(): void
    {
        MockInjector::inject($this);

        $this->assertInstanceOf(Service::class, $this->service);

        if (isset($this->otherService)) {
            $this->fail('The @InjectMocks annotation should use first one.');
        }
    }
}
