<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit;

use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;

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
}
