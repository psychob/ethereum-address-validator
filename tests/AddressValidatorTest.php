<?php

namespace Tests\PsychoB\Ethereum;

use PHPUnit\Framework\TestCase;
use PsychoB\Ethereum\AddressValidator;

class AddressValidatorTest extends TestCase
{
    public function testIsValid()
    {
        $this->assertEquals(AddressValidator::ADDRESS_VALID, AddressValidator::isValid('0x3b6969198Aa794AAc16feEEa051a345BD806A16e'));
        $this->assertEquals(AddressValidator::ADDRESS_CHECKSUM_INVALID, AddressValidator::isValid('0x3b6969198aa794AAc16feEEa051a345BD806A16e'));
        $this->assertEquals(AddressValidator::ADDRESS_INVALID, AddressValidator::isValid('0x3b6969198aa794AAc16feEEa051a'));
        $this->assertEquals(AddressValidator::ADDRESS_INVALID, AddressValidator::isValid('0x3b6969198Aa794AAc16feEEa051a345BD806A16eAAc'));
        $this->assertEquals(AddressValidator::ADDRESS_VALID, AddressValidator::isValid('0x3b6969198aa794aac16feeea051a345bd806a16e'));
    }

    public function testIsCanonical()
    {
        $this->assertEquals('0x3b6969198Aa794AAc16feEEa051a345BD806A16e', AddressValidator::getCanonicalAddress('0x3b6969198Aa794AAc16feEEa051a345BD806A16e'));
        $this->assertEquals('0x3b6969198Aa794AAc16feEEa051a345BD806A16e', AddressValidator::getCanonicalAddress('0x3b6969198aa794AAc16feEEa051a345BD806A16e'));
        $this->assertNull(AddressValidator::getCanonicalAddress('0x3b6969198aa794AAc16feEEa051a'));
        $this->assertNull(AddressValidator::getCanonicalAddress('0x3b6969198Aa794AAc16feEEa051a345BD806A16eAAc'));
        $this->assertEquals('0x3b6969198Aa794AAc16feEEa051a345BD806A16e', AddressValidator::getCanonicalAddress('0x3b6969198aa794aac16feeea051a345bd806a16e'));
    }
}