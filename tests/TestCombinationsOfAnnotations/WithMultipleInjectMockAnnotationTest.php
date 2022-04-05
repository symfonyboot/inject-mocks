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
