<?php

namespace SilasYudi\InjectMocks\Tests\TestServicesWithPrimitiveTypeParameters\Classes;

use DateTime;
use stdClass;

class ServiceWithPrimitiveTypeThatAllowNullOrHasDefaultParameter
{

    private Dependency $notAuwowired;
    private DateTime $dateTime;
    private stdClass $stdClass;
    private ?string $allowNull;
    private string $string;
    private bool $boolean;
    private int $integer;
    private float $float;
    private array $array;
    private ?stdClass $nullStdClass;

    public function __construct(
        Dependency $notAuwowired,
        DateTime $dateTime,
        stdClass $stdClass,
        ?string $allowNull,
        string $string = '',
        bool $boolean = true,
        int $integer = 1,
        float $float = 2,
        array $array = [3],
        stdClass $nullStdClass = null
    ) {
        $this->notAuwowired = $notAuwowired;
        $this->dateTime = $dateTime;
        $this->stdClass = $stdClass;
        $this->allowNull = $allowNull;
        $this->string = $string;
        $this->boolean = $boolean;
        $this->integer = $integer;
        $this->float = $float;
        $this->array = $array;
        $this->nullStdClass = $nullStdClass;
    }

    public function getNotAuwowired(): Dependency
    {
        return $this->notAuwowired;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    public function getStdClass(): stdClass
    {
        return $this->stdClass;
    }

    public function getAllowNull(): ?string
    {
        return $this->allowNull;
    }

    public function getString(): string
    {
        return $this->string;
    }

    public function isBoolean(): bool
    {
        return $this->boolean;
    }

    public function getInteger(): int
    {
        return $this->integer;
    }

    public function getFloat()
    {
        return $this->float;
    }

    public function getArray(): array
    {
        return $this->array;
    }

    public function getNullStdClass(): ?stdClass
    {
        return $this->nullStdClass;
    }
}
