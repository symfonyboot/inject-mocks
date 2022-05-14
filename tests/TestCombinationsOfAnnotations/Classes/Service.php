<?php

namespace SilasYudi\InjectMocks\Tests\TestCombinationsOfAnnotations\Classes;

class Service
{

    private DependencyA $dependencyA;
    private DependencyB $dependencyB;

    public function __construct(DependencyA $dependencyA, DependencyB $dependencyB)
    {
        $this->dependencyA = $dependencyA;
        $this->dependencyB = $dependencyB;
    }

    public function getDependencyA(): DependencyA
    {
        return $this->dependencyA;
    }

    public function getDependencyB(): DependencyB
    {
        return $this->dependencyB;
    }
}
