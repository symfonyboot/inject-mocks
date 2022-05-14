<?php

namespace SilasYudi\InjectMocks\Tests\TestWithoutConstructor\Classes;

class Service
{

    private DependencyA $dependencyA;
    private DependencyB $dependencyB;

    public function getDependencyA(): DependencyA
    {
        return $this->dependencyA;
    }

    public function getDependencyB(): DependencyB
    {
        return $this->dependencyB;
    }
}
