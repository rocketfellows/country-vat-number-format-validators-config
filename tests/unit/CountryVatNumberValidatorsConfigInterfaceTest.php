<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit;

use arslanimamutdinov\ISOStandard3166\Country;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\CountryVatNumberFormatValidatorsConfigInterface;

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

    /**
     * @return Country|MockObject
     */
    protected function getCountryMock(array $params = []): Country
    {
        /** @var Country|MockObject $mock */
        $mock = $this->createMock(Country::class);

        if (isset($params['alpha2'])) {
            $mock->method('getAlpha2')->willReturn($params['alpha2']);
        }

        if (isset($params['alpha3'])) {
            $mock->method('getAlpha3')->willReturn($params['alpha3']);
        }

        if (isset($params['numericCode'])) {
            $mock->method('getNumericCode')->willReturn($params['numericCode']);
        }

        if (isset($params['name'])) {
            $mock->method('getName')->willReturn($params['name']);
        }

        return $mock;
    }
}
