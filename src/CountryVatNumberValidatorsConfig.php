<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig;

use arslanimamutdinov\ISOStandard3166\Country;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;

class CountryVatNumberValidatorsConfig implements CountryVatNumberFormatValidatorsConfigInterface
{
    private $country;
    private $validators;

    public function __construct(Country $country, CountryVatFormatValidators $validators)
    {
        $this->country = $country;
        $this->validators = $validators;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function getValidators(): CountryVatFormatValidators
    {
        return $this->validators;
    }
}
