# Country vat number format validator config interface

![Code Coverage Badge](./badge.svg)

This package provides an interface for configuring country-specific vat number format validators.
In other words, the interface helps to unambiguously specify a set of validators (in the form of a tuple) for a particular country.
Also in this package are presented:
- a simple implementation of the interface in the form of a DTO;
- implementation of a tuple of objects that implement the interface for configuring vat number format validators for a specific country.

## Installation

```shell
composer require rocketfellows/country-vat-number-format-validators-config
```

## Dependencies

- https://github.com/rocketfellows/country-vat-format-validator-interface
- https://github.com/arslanim/iso-standard-3166
- https://github.com/rocketfellows/tuple

## List of package components

- **_CountryVatNumberFormatValidatorsConfigInterface_** - interface for configuring country-specific vat number format validators;
- **_CountryVatNumberValidatorsConfig_** - simple implementation of **_CountryVatNumberFormatValidatorsConfigInterface_** interface, which is a DTO initialized, by country (an object of type Country) and tuple of validators (a list of objects of type **_CountryVatFormatValidatorInterface_**);
- **_CountryVatNumberFormatValidatorsConfigs_** - vat number format validators configuration tuple for countries, is a list of elements, each element of which is an object of type **_CountryVatNumberFormatValidatorsConfigInterface_**, also provides a number of functions for searching by tuple;

## CountryVatNumberFormatValidatorsConfigInterface description

Interface for configuring country-specific vat number format validators.

Methods that class must implement according to the interface:
- **_getCountry_** - country object getter, must return an object of type **_arslanimamutdinov\ISOStandard3166\Country_**;
- **_getValidators_** - vat number format validators tuple getter, must return an object of type **_rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators_**;

## CountryVatNumberValidatorsConfig description

Simple implementation of **_CountryVatNumberFormatValidatorsConfigInterface_** interface, which is a DTO initialized, by country (an object of type Country) and tuple of validators (a list of objects of type **_CountryVatFormatValidatorInterface_**).

The class constructor takes two parameters:
- **_$country_** - object instance of arslanimamutdinov\ISOStandard3166\Country;
- **_$validators_** - vat number format validators tuple, an object of type **_rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators_**;

Object instantiating example:

```php
/**
* FirstRUVatNumberValidator and SecondRUVatNumberValidator are implemented CountryVatFormatValidatorInterface
*/
$validators = new CountryVatFormatValidators(new FirstRUVatNumberValidator(), new SecondRUVatNumberValidator());
$config = new CountryVatNumberValidatorsConfig(Country::RU(), $validators);

$config->getCountry();      // will return RU country object
$config->getValidators();   // will return $validators tuple
```

## CountryVatNumberFormatValidatorsConfigs description

Vat number format validators configuration tuple for countries.
Is a list of elements, each element of which is an object of type **_CountryVatNumberFormatValidatorsConfigInterface_**.
Also provides a number of functions for searching by tuple.

Tuple provides looping by its elements:

```php
// implements CountryVatNumberFormatValidatorsConfigInterface
$ruVatNumberFormatValidatorsConfig = new CountryVatNumberValidatorsConfig(
    Country::RU(),
    new CountryVatFormatValidators(new RUVatNumberFormatValidator())
);

// implements CountryVatNumberFormatValidatorsConfigInterface
$deVatNumberFormatValidatorsConfig = new CountryVatNumberValidatorsConfig(
    Country::DE(),
    new CountryVatFormatValidators(new DEVatNumberFormatValidator())
);

// implements CountryVatNumberFormatValidatorsConfigInterface
$atVatNumberFormatValidatorsConfig = new CountryVatNumberValidatorsConfig(
    Country::AT(),
    new CountryVatFormatValidators(new ATVatNumberFormatValidator())
);

$configs = new CountryVatNumberFormatValidatorsConfigs(
    $ruVatNumberFormatValidatorsConfig,
    $deVatNumberFormatValidatorsConfig,
    $atVatNumberFormatValidatorsConfig
);

// each $config variable is an instance of CountryVatNumberFormatValidatorsConfigInterface
foreach ($configs as $config) {
    $config->getCountry();      // returns Country of current config
    $config->getValidators();   // return CountryVatFormatValidators of current config
}
```

**_CountryVatNumberFormatValidatorsConfigs_** public functions:
- **_getCountryValidators(Country $country)_** - returns unique validators (object instance of CountryVatFormatValidators) for given **_Country_** object from tuple, if there is not validators for given country will return empty tuple;
- **_getValidatorsByCountryCode(string $countryCode)_** - returns unique validators (object instance of **_CountryVatFormatValidators_**) for given country code (search by alpha2, alpha3 and numeric code) from tuple, if there is not validators for given country code will return empty tuple;

Search functions will return a **_CountryVatFormatValidators_** tuple, which will consist of a list of unique validators.
For example, the initial configuration tuple **_CountryVatNumberFormatValidatorsConfigs_** may contain several configurations for the same country.
In this case, the tuple will contain unique validators from all configurations of the desired country.
Also, one configuration can be given for a country, but it can contain the same validators, in which case the tuple of validators for the desired country will also consist of unique validators.

More search use cases can be found in tests:
- **_rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\GetCountryValidatorsTest_**;
- **_rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit\GetValidatorsByCountryCodeTest_**;

## Contributing

Welcome to pull requests. If there is a major changes, first please open an issue for discussion.

Please make sure to update tests as appropriate.
