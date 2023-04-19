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
        $this->assertEquals($expectedValidators, $actualValidators);
    }

    public function getConfigProvidedData(): array
    {
        return [
            'country without validators' => [
                'country' => $this->getCountryMock(),
                'validators' => [],
            ],
            'country with one validator' => [
                'country' => $this->getCountryMock(),
                'validators' => [
                    $this->createMock(CountryVatFormatValidatorInterface::class),
                ],
            ],
            'country with multiple validators' => [
                'country' => $this->getCountryMock(),
                'validators' => [
                    $this->createMock(CountryVatFormatValidatorInterface::class),
                    $this->createMock(CountryVatFormatValidatorInterface::class),
                    $this->createMock(CountryVatFormatValidatorInterface::class),
                ],
            ],
        ];
    }
}
