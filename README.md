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

## List of package components

- CountryVatNumberFormatValidatorsConfigInterface - interface for configuring country-specific vat number format validators;
- CountryVatNumberValidatorsConfig - simple implementation of CountryVatNumberFormatValidatorsConfigInterface interface, which is a DTO initialized, by country (an object of type Country) and tuple of validators (a list of objects of type CountryVatFormatValidatorInterface);
- CountryVatNumberFormatValidatorsConfigs - vat number format validators configuration tuple for countries, is a list of elements, each element of which is an object of type CountryVatNumberFormatValidatorsConfigInterface, also provides a number of functions for searching by tuple;

## CountryVatNumberFormatValidatorsConfigInterface description

Interface for configuring country-specific vat number format validators.

Methods that class must implement according to the interface:
- getCountry - country object getter, must return an object of type arslanimamutdinov\ISOStandard3166\Country;
- getValidators - vat number format validators tuple getter, must return an object of type rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;

## Contributing

Welcome to pull requests. If there is a major changes, first please open an issue for discussion.

Please make sure to update tests as appropriate.

