<?php

namespace SilasYudi\InjectMocks\Tests\TestMultipleMocksWithSameType\Classes;

class Service
{

    private Dependency $dependencyOne;
    private Dependency $dependencyTwo;
    private Dependency $dependencyThree;

    public function __construct(
        Dependency $dependencyOne,
        Dependency $dependencyTwo,
        Dependency $dependencyThree
    ) {
        $this->dependencyOne = $dependencyOne;
        $this->dependencyTwo = $dependencyTwo;
        $this->dependencyThree = $dependencyThree;
    }

    public function getDependencyOne(): Dependency
    {
        return $this->dependencyOne;
    }

    public function getDependencyTwo(): Dependency
    {
        return $this->dependencyTwo;
    }

    public function getDependencyThree(): Dependency
    {
        return $this->dependencyThree;
    }
}
