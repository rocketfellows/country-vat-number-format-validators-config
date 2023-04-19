<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit;

use arslanimamutdinov\ISOStandard3166\ISO3166;
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

class GetValidatorsByCountryCodeTest extends CountryVatNumberFormatValidatorsConfigsTest
{
    /**
     * @dataProvider getCountryValidatorsConfigByCountryCodeProvidedData
     * @param CountryVatNumberFormatValidatorsConfigs $countriesConfigs
     * @param string $givenCountryCode
     * @param CountryVatFormatValidatorInterface[] $expectedValidators
     */
    public function testGetValidatorsByCountryCode(
        CountryVatNumberFormatValidatorsConfigs $countriesConfigs,
        string $givenCountryCode,
        array $expectedValidators
    ): void {
        $validators = $countriesConfigs->getValidatorsByCountryCode($givenCountryCode);

        $actualValidators = [];
        foreach ($validators as $validator) {
            $actualValidators[] = $validator;
        }


        $this->assertEquals($expectedValidators, $actualValidators);
    }

    public function getCountryValidatorsConfigByCountryCodeProvidedData(): array
    {
        return [
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(),
                'givenCountry' => 'ru',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
                'expectedValidators' => [
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
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
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
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
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
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
                'givenCountry' => 'ru',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
                'expectedValidators' => [
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
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
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
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
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'ru',
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
                'givenCountry' => 'rus',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
                'expectedValidators' => [
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
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
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
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
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
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
                'givenCountry' => 'rus',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
                'expectedValidators' => [
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
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
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
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
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => 'rus',
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
                'givenCountry' => '643',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
                'expectedValidators' => [
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
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
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
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
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
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
                'givenCountry' => '643',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
                'expectedValidators' => [
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
                'expectedValidators' => [],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
                'expectedValidators' => [
                    new FirstRUVatNumberValidator(),
                    new SecondRUVatNumberValidator(),
                    new ThirdRUVatNumberValidator(),
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
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
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
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
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstRUVatNumberValidator(),
                            new SecondRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::RU(),
                        'validators' => new CountryVatFormatValidators(
                            new ThirdRUVatNumberValidator(),
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::DE(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstDEVatNumberValidator(),
                            new SecondDEVatNumberValidator(),
                            new ThirdDEVatNumberValidator(),
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => ISO3166::AT(),
                        'validators' => new CountryVatFormatValidators(
                            new FirstATVatNumberValidator(),
                            new SecondATVatNumberValidator(),
                            new ThirdATVatNumberValidator(),
                        ),
                    ]),
                ),
                'givenCountry' => '643',
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
