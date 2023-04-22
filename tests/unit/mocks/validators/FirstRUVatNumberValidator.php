<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\mocks\validators;

use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidatorInterface;

class FirstRUVatNumberValidator implements CountryVatFormatValidatorInterface
{
    public function isValid(string $vatNumber): bool
    {
        return true;
    }
}
