<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig;

use arslanimamutdinov\ISOStandard3166\Country;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidatorInterface;
use rocketfellows\CountryVatFormatValidatorInterface\CountryVatFormatValidators;
use rocketfellows\tuple\Tuple;

class CountryVatNumberFormatValidatorsConfigs extends Tuple
{
    /**
     * @var CountryVatNumberFormatValidatorsConfigInterface[]
     */
    protected $data = [];

    public function __construct(CountryVatNumberFormatValidatorsConfigInterface ...$config)
    {
        parent::__construct(...$config);
    }

    public function current(): ?CountryVatNumberFormatValidatorsConfigInterface
    {
        return parent::current();
    }

    public function getCountryValidators(Country $country): CountryVatFormatValidators
    {
        /** @var CountryVatFormatValidatorInterface[] $foundValidators */
        $foundValidators = [];

        foreach ($this->data as $config) {
            if (strtoupper($config->getCountry()->getAlpha2()) !== strtoupper($country->getAlpha2())) {
                continue;
            }

            $this->collectUniqueValidators($foundValidators, $config->getValidators());
        }

        return !empty($foundValidators) ?
            new CountryVatFormatValidators(...$foundValidators) : new CountryVatFormatValidators();
    }

    public function getValidatorsByCountryCode(string $countryCode): CountryVatFormatValidators
    {
        /** @var CountryVatFormatValidatorInterface[] $foundValidators */
        $foundValidators = [];
        $formattedCountryCode = strtoupper($countryCode);

        foreach ($this->data as $config) {
            if (
                (strtoupper($config->getCountry()->getAlpha2()) !== $formattedCountryCode) &&
                (strtoupper($config->getCountry()->getAlpha3()) !== $formattedCountryCode) &&
                (strtoupper($config->getCountry()->getNumericCode()) !== $formattedCountryCode)
            ) {
                continue;
            }

            $this->collectUniqueValidators($foundValidators, $config->getValidators());
        }

        return !empty($foundValidators) ?
            new CountryVatFormatValidators(...$foundValidators) : new CountryVatFormatValidators();
    }

    /**
     * @param CountryVatFormatValidatorInterface[] $foundValidators
     * @param CountryVatFormatValidators $validators
     */
    private function collectUniqueValidators(array &$foundValidators, CountryVatFormatValidators $validators): void
    {
        foreach ($validators as $validator) {
            if ($this->isExistValidatorInGivenArray($foundValidators, $validator)) {
                continue;
            }

            $foundValidators[] = $validator;
        }
    }

    /**
     * @param CountryVatFormatValidatorInterface[] $givenValidators
     * @param CountryVatFormatValidatorInterface $searchingValidator
     * @return bool
     */
    private function isExistValidatorInGivenArray(
        array $givenValidators,
        CountryVatFormatValidatorInterface $searchingValidator
    ): bool {
        foreach ($givenValidators as $givenValidator) {
            if ($givenValidator == $searchingValidator) {
                return true;
            }
        }

        return false;
    }
}
