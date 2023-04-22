<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit;

use arslanimamutdinov\ISOStandard3166\Country;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\CountryVatNumberFormatValidatorsConfigInterface;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\CountryVatNumberFormatValidatorsConfigs;

abstract class CountryVatNumberFormatValidatorsConfigsTest extends TestCase
{
    /**
     * @dataProvider getConfigInitializationProvidedData
     * @param CountryVatNumberFormatValidatorsConfigInterface[] $expectedConfigsArray
     */
    public function testCountryVatNumberFormatValidatorsConfigsInitialization(array $expectedConfigsArray): void
    {
        $configs = new CountryVatNumberFormatValidatorsConfigs(...$expectedConfigsArray);

        $actualConfigsArray = [];
        foreach ($configs as $config) {
            $actualConfigsArray[] = $config;
        }

        $this->assertEquals($expectedConfigsArray, $actualConfigsArray);
    }

    public function getConfigInitializationProvidedData(): array
    {
        return [
            'empty config' => [
                'expectedConfigsArray' => [],
            ],
            'one config' => [
                'expectedConfigsArray' => [
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock(),
                        'validators' => $this->createMock(CountryVatFormatValidators::class),
                    ]),
                ],
            ],
            'multiple configs' => [
                'expectedConfigsArray' => [
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock(),
                        'validators' => $this->createMock(CountryVatFormatValidators::class),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock(),
                        'validators' => $this->createMock(CountryVatFormatValidators::class),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock(),
                        'validators' => $this->createMock(CountryVatFormatValidators::class),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock(),
                        'validators' => $this->createMock(CountryVatFormatValidators::class),
                    ]),
                ],
            ],
        ];
    }

    /**
     * @param array $params
     * @return Country
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

    protected function getCountryVatNumberFormatValidatorsConfigMock(
        array $params
    ): CountryVatNumberFormatValidatorsConfigInterface {
        /** @var MockObject|CountryVatNumberFormatValidatorsConfigInterface $mock */
        $mock = $this->createMock(CountryVatNumberFormatValidatorsConfigInterface::class);
        $mock->method('getCountry')->willReturn($params['country']);
        $mock->method('getValidators')->willReturn($params['validators']);

        return $mock;
    }
}
