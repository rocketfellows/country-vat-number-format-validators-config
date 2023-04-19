<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit;

use PHPUnit\Framework\TestCase;

abstract class CountryVatNumberValidatorsConfigInterfaceTest extends TestCase
{
    private const EXPECTED_IMPLEMENTED_INTERFACES = [
        CountryVatNumberFormatValidatorsConfigInterface::class,
    ];

    protected $config;

    public function testConfigImplementedExpectedInterfaces(): void
    {
        foreach (self::EXPECTED_IMPLEMENTED_INTERFACES as $expectedImplementedInterface) {
            $this->assertInstanceOf($expectedImplementedInterface, $this->config);
        }
    }
}
