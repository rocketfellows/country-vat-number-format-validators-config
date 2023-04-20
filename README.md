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

- CountryVatNumberFormatValidatorsConfigInterface - interface for configuring country-specific vat number format validators;
- CountryVatNumberValidatorsConfig - simple implementation of CountryVatNumberFormatValidatorsConfigInterface interface, which is a DTO initialized, by country (an object of type Country) and tuple of validators (a list of objects of type CountryVatFormatValidatorInterface);
- CountryVatNumberFormatValidatorsConfigs - vat number format validators configuration tuple for countries, is a list of elements, each element of which is an object of type CountryVatNumberFormatValidatorsConfigInterface, also provides a number of functions for searching by tuple;

## CountryVatNumberFormatValidatorsConfigInterface description

Interface for configuring country-specific vat number format validators.

Methods that class must implement according to the interface:
- getCountry - country object getter, must return an object of type arslanimamutdinov\ISOStandard3166\Country;
- getValidators - vat number format validators tuple getter, must return an object of type rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;

## CountryVatNumberValidatorsConfig description

Simple implementation of CountryVatNumberFormatValidatorsConfigInterface interface, which is a DTO initialized, by country (an object of type Country) and tuple of validators (a list of objects of type CountryVatFormatValidatorInterface).

The class constructor takes two parameters:
- $country - object instance of arslanimamutdinov\ISOStandard3166\Country;
- $validators - vat number format validators tuple, an object of type rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;

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
Is a list of elements, each element of which is an object of type CountryVatNumberFormatValidatorsConfigInterface.
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

## Contributing

Welcome to pull requests. If there is a major changes, first please open an issue for discussion.

Please make sure to update tests as appropriate.

