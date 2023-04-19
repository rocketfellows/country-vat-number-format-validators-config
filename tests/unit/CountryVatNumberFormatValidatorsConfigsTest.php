<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit;

use arslanimamutdinov\ISOStandard3166\Country;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidatorInterface;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\CountryVatNumberFormatValidatorsConfigInterface;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\CountryVatNumberFormatValidatorsConfigs;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\mocks\validators\FirstATVatNumberValidator;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\mocks\validators\FirstDEVatNumberValidator;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\mocks\validators\FirstRUVatNumberValidator;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\mocks\validators\SecondATVatNumberValidator;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\mocks\validators\SecondDEVatNumberValidator;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\mocks\validators\SecondRUVatNumberValidator;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\mocks\validators\ThirdATVatNumberValidator;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\mocks\validators\ThirdDEVatNumberValidator;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\mocks\validators\ThirdRUVatNumberValidator;

class CountryVatNumberFormatValidatorsConfigsTest extends TestCase
{
    /**
     * @dataProvider getCountryValidatorsConfigProvidedData
     * @param CountryVatNumberFormatValidatorsConfigs $countriesConfigs
     * @param Country $givenCountry
     * @param CountryVatFormatValidatorInterface[] $expectedValidators
     */
    public function testGetCountryValidators(
        CountryVatNumberFormatValidatorsConfigs $countriesConfigs,
        Country $givenCountry,
        array $expectedValidators
    ): void {
        $validators = $countriesConfigs->getCountryValidators($givenCountry);

        $actualValidators = [];
        foreach ($validators as $validator) {
            $actualValidators[] = $validator;
        }


        $this->assertEquals($expectedValidators, $actualValidators);
    }

    public function getCountryValidatorsConfigProvidedData(): array
    {
        return [
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'DE',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'AT',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => $this->getCountryMock(['alpha2' => 'RU',]),
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
        ];
    }

    /**
     * @param array $params
     * @return Country
     */
    private function getCountryMock(array $params = []): Country
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

    public function getCountryVatNumberFormatValidatorsConfigMock(
        array $params
    ): CountryVatNumberFormatValidatorsConfigInterface {
        /** @var MockObject|CountryVatNumberFormatValidatorsConfigInterface $mock */
        $mock = $this->createMock(CountryVatNumberFormatValidatorsConfigInterface::class);
        $mock->method('getCountry')->willReturn($params['country']);
        $mock->method('getValidators')->willReturn($params['validators']);

        return $mock;
    }
}
