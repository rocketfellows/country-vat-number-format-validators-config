<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig;

use arslanimamutdinov\ISOStandard3166\Country;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;

interface CountryVatNumberFormatValidatorsConfigInterface
{
    public function getCountry(): Country;
    public function getValidators(): CountryVatFormatValidators;
}
