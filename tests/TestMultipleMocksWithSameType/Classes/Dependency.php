<?php

namespace SilasYudi\InjectMocks\Tests\TestMultipleMocksWithSameType\Classes;

class Dependency
{
    public function getSomething(): int {
        return 1;
    }
}
