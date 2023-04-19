<?php

namespace rocketfellows\CountryVatNumberFormatValidatorsConfig\tests\unit;

use PHPUnit\Framework\TestCase;
use rocketfellows\tuple\Tuple;

class CountryVatNumberFormatValidatorsConfigsTest extends TestCase
{
    public function testSuccessEmptyInitialization(): void
    {
        $this->assertInstanceOf(Tuple::class, new CountryVatNumberFormatValidatorsConfigs());
    }
}
