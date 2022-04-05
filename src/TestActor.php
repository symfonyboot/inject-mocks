<?php

namespace SymfonyBoot\InjectMocks;

class TestActor
{

    private string $parameter;
    private string $type;
    private object $instance;

    public function __construct(string $parameter, string $type, object $instance)
    {
        $this->parameter = $parameter;
        $this->type = $type;
        $this->instance = $instance;
    }

    public function getParameter(): string
    {
        return $this->parameter;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getInstance(): object
    {
        return $this->instance;
    }
}
