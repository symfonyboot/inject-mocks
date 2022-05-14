<?php

namespace SilasYudi\InjectMocks\Tests\TestServicesWithPrimitiveTypeParameters\Classes;

class ServiceWithAutowirePrimitiveType
{

    private Dependency $notAuwowired;
    private string $autowire;

    public function __construct(Dependency $notAutowired, string $autowire)
    {
        $this->notAuwowired = $notAutowired;
        $this->autowire = $autowire;
    }
}
