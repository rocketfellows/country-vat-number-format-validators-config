<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit;

use arslanimamutdinov\ISOStandard3166\Country;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidatorInterface;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;
use rocketfellows\CountryVatNumberFormatValidatorsConfig\CountryVatNumberValidatorsConfig;

class CountryVatNumberValidatorsConfigTest extends CountryVatNumberValidatorsConfigInterfaceTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->config = new CountryVatNumberValidatorsConfig(
            $this->getCountryMock(),
            $this->createMock(CountryVatFormatValidators::class)
        );
    }

    /**
     * @dataProvider getConfigProvidedData
     * @param Country $expectedCountry
     * @param CountryVatFormatValidatorInterface[] $expectedValidators
     */
    public function testSuccessInitialization(
        Country $expectedCountry,
        array $expectedValidators
    ): void {
        $this->config = new CountryVatNumberValidatorsConfig(
            $expectedCountry,
            new CountryVatFormatValidators(...$expectedValidators)
        );

        $actualValidators = [];
        foreach ($this->config->getValidators() as $actualValidator) {
            $actualValidators[] = $actualValidator;
        }

        $this->assertEquals($expectedCountry, $this->config->getCountry());
        $this->assertEquals($expectedCountry->getAlpha2(), $this->config->getCountry()->getAlpha2());
        $this->assertEquals($expectedCountry->getAlpha3(), $this->config->getCountry()->getAlpha3());
        $this->assertEquals($expectedCountry->getNumericCode(), $this->config->getCountry()->getNumericCode());
        $this->assertEquals($expectedCountry->getName(), $this->config->getCountry()->getName());
        $this->assertEquals($expectedValidators, $actualValidators);
    }

    public function getConfigProvidedData(): array
    {
        return [
            'country without validators' => [
                'country' => $this->getCountryMock([
                    'alpha2' => 'fo',
                    'alpha3' => 'foo',
                    'numericCode' => '111',
                    'name' => 'Foo Bar'
                ]),
                'validators' => [],
            ],
            'country with one validator' => [
                'country' => $this->getCountryMock([
                    'alpha2' => 'fo',
                    'alpha3' => 'foo',
                    'numericCode' => '111',
                    'name' => 'Foo Bar'
                ]),
                'validators' => [
                    $this->createMock(CountryVatFormatValidatorInterface::class),
                ],
            ],
            'country with multiple validators' => [
                'country' => $this->getCountryMock([
                    'alpha2' => 'fo',
                    'alpha3' => 'foo',
                    'numericCode' => '111',
                    'name' => 'Foo Bar'
                ]),
                'validators' => [
                    $this->createMock(CountryVatFormatValidatorInterface::class),
                    $this->createMock(CountryVatFormatValidatorInterface::class),
                    $this->createMock(CountryVatFormatValidatorInterface::class),
                ],
            ],
        ];
    }
}
