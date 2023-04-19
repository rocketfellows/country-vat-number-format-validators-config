<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit;

use arslanimamutdinov\ISOStandard3166\Country;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidatorInterface;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;
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

class GetCountryValidatorsTest extends CountryVatNumberFormatValidatorsConfigsTest
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
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(),
                'givenCountry' => $this->getCountryMock(['alpha2' => 'RU',]),
                'expectedValidators' => [],
            ],
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
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
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
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(),
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
                'expectedValidators' => [],
            ],
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
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
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
                    new FirstDEVatNumberValidator(),
                    new SecondDEVatNumberValidator(),
                    new ThirdDEVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
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
                    new FirstDEVatNumberValidator(),
                    new SecondDEVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(),
                'givenCountry' => $this->getCountryMock(['alpha2' => 'ru',]),
                'expectedValidators' => [],
            ],
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
                'givenCountry' => $this->getCountryMock(['alpha2' => 'ru',]),
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
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
                'givenCountry' => $this->getCountryMock(['alpha2' => 'ru',]),
                'expectedValidators' => [
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(),
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
                'givenCountry' => $this->getCountryMock(['alpha2' => 'ru',]),
                'expectedValidators' => [],
            ],
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
                'givenCountry' => $this->getCountryMock(['alpha2' => 'ru',]),
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
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
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
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
                'givenCountry' => $this->getCountryMock(['alpha2' => 'ru',]),
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                    new FirstDEVatNumberValidator(),
                    new SecondDEVatNumberValidator(),
                    new ThirdDEVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $this->getCountryMock([
                            'alpha2' => 'RU',
                        ]),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
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
                'givenCountry' => $this->getCountryMock(['alpha2' => 'ru',]),
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                    new FirstDEVatNumberValidator(),
                    new SecondDEVatNumberValidator(),
                ],
            ],
        ];
    }
}
