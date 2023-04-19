<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit;

use arslanimamutdinov\ISOStandard3166\Country;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidatorInterface;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\CountryVatNumberFormatValidatorsConfigInterface;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\CountryVatNumberFormatValidatorsConfigs;
use rocketfellows\tuple\Tuple;

class CountryVatNumberFormatValidatorsConfigsTest extends TestCase
{
    public function testSuccessEmptyInitialization(): void
    {
        $this->assertInstanceOf(Tuple::class, new CountryVatNumberFormatValidatorsConfigs());
    }

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
        $ruCountry = $this->getCountryMock([
            'alpha2' => 'RU',
        ]);
        $firstRUCountryVatValidator = $this->createMock(CountryVatFormatValidatorInterface::class);
        $secondRUCountryVatValidator = $this->createMock(CountryVatFormatValidatorInterface::class);
        $thirdRUCountryVatValidator = $this->createMock(CountryVatFormatValidatorInterface::class);

        $deCountry = $this->getCountryMock([
            'alpha2' => 'DE',
        ]);
        $firstDECountryVatValidator = $this->createMock(CountryVatFormatValidatorInterface::class);
        $secondDECountryVatValidator = $this->createMock(CountryVatFormatValidatorInterface::class);
        $thirdDECountryVatValidator = $this->createMock(CountryVatFormatValidatorInterface::class);

        $atCountry = $this->getCountryMock([
            'alpha2' => 'AT',
        ]);
        $firstATCountryVatValidator = $this->createMock(CountryVatFormatValidatorInterface::class);
        $secondATCountryVatValidator = $this->createMock(CountryVatFormatValidatorInterface::class);
        $thirdATCountryVatValidator = $this->createMock(CountryVatFormatValidatorInterface::class);

        return [
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $ruCountry,
                        'validators' => new CountryVatFormatValidators(
                            $firstRUCountryVatValidator,
                            $secondRUCountryVatValidator,
                            $thirdRUCountryVatValidator
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $deCountry,
                        'validators' => new CountryVatFormatValidators(
                            $firstDECountryVatValidator,
                            $secondDECountryVatValidator,
                            $thirdDECountryVatValidator
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $atCountry,
                        'validators' => new CountryVatFormatValidators(
                            $firstATCountryVatValidator,
                            $secondATCountryVatValidator,
                            $thirdATCountryVatValidator
                        ),
                    ]),
                ),
                'givenCountry' => $this->getCountryMock(['alpha2' => 'RU',]),
                'expectedValidators' => [
                    $firstRUCountryVatValidator,
                    $secondRUCountryVatValidator,
                    $thirdRUCountryVatValidator,
                ],
            ],
            [
                'countriesConfigs' => new CountryVatNumberFormatValidatorsConfigs(
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $ruCountry,
                        'validators' => new CountryVatFormatValidators(
                            $firstRUCountryVatValidator,
                            $secondRUCountryVatValidator,
                            $thirdRUCountryVatValidator
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $deCountry,
                        'validators' => new CountryVatFormatValidators(
                            $firstDECountryVatValidator,
                            $secondDECountryVatValidator,
                            $thirdDECountryVatValidator
                        ),
                    ]),
                    $this->getCountryVatNumberFormatValidatorsConfigMock([
                        'country' => $atCountry,
                        'validators' => new CountryVatFormatValidators(
                            $firstATCountryVatValidator,
                            $secondATCountryVatValidator,
                            $thirdATCountryVatValidator
                        ),
                    ]),
                ),
                'givenCountry' => $this->getCountryMock(['alpha2' => 'DE',]),
                'expectedValidators' => [
                    $firstDECountryVatValidator,
                    $secondDECountryVatValidator,
                    $thirdDECountryVatValidator,
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
