<?php

namespace SymfonyBoot\InjectMocks\Tests\TestWithInstantiedActors\Classes;

class Service
{

    private Dependency $dependency;

    public function __construct(Dependency $dependency)
    {
        $this->dependency = $dependency;
    }

    public function getDependency(): Dependency
    {
        return $this->dependency;
    }
}
