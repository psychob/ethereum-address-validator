<?php
    //
    // psychob/ethereum-address-validator
    // (c) 2018 - 2019 RGB Lighthouse <https://rgblighthouse.pl>
    // (c) 2018 - 2019 Andrzej Budzanowski <kontakt@andrzej.budzanowski.pl>
    // --
    // See LICENSE for license information.
    //

    namespace Tests\PsychoB\Ethereum;

    use PHPUnit\Framework\TestCase;
    use PsychoB\Ethereum\AddressValidator;

    class AddressValidatorTest extends TestCase
    {
        public function providerTestIsValid()
        {
            return [
                ['0xA477941c7AAD6536f175ef123bf9eeD6F82A4c85'], // with checksum
                ['0xa477941c7aad6536f175ef123bf9eed6f82a4c85'], // without checksum, lower case
                ['0xA477941C7AAD6536F175EF123BF9EED6F82A4C85'], // without checksum, upper case
            ];
        }

        /** @dataProvider providerTestIsValid */
        public function testIsValid(string $address)
        {
            $this->assertEquals(AddressValidator::ADDRESS_VALID, AddressValidator::isValid($address));
        }

        public function providerTestIsInValidChecksum()
        {
            return [
                ['0xA477941c7aad6536f175ef123bf9eeD6F82A4c85'], // invalid checksum, capitalisation
                ['0xA477941c7aFd6536f175ef123bf9eeD6F82A4c85'], // invalid checksum, wrong address
            ];
        }

        /** @dataProvider providerTestIsInValidChecksum */
        public function testIsInValidChecksum(string $address)
        {
            $this->assertEquals(AddressValidator::ADDRESS_CHECKSUM_INVALID, AddressValidator::isValid($address));
        }

        public function providerTestIsInvalid()
        {
            return [
                ['0xA477941c7AAD6536f175ef123bf9eeD6F82A4c8'], // too short address
                ['0xA477941c7AAD6536f175ef123bf9eeD6F82A4c856'], // address too long
                [''],
            ];
        }

        /** @dataProvider providerTestIsInvalid */
        public function testIsInvalid(string $address)
        {
            $this->assertEquals(AddressValidator::ADDRESS_INVALID, AddressValidator::isValid($address));
        }

        public function providerTestGetCanonical()
        {
            return [
                ['0xA477941c7AAD6536f175ef123bf9eeD6F82A4c85', '0xA477941c7AAD6536f175ef123bf9eeD6F82A4c85'],
                ['0xa477941c7aad6536f175ef123bf9eed6f82a4c85', '0xA477941c7AAD6536f175ef123bf9eeD6F82A4c85'],
                ['0xA477941C7AAD6536F175EF123BF9EED6F82A4C85', '0xA477941c7AAD6536f175ef123bf9eeD6F82A4c85'],
                ['0xA477941c7aad6536f175ef123bf9eeD6F82A4c85', '0xA477941c7AAD6536f175ef123bf9eeD6F82A4c85'],
                ['0xA477941c7aFd6536f175ef123bf9eeD6F82A4c85', '0xa477941c7aFD6536f175ef123bf9eed6f82A4C85'],
                ['', NULL],
            ];
        }

        /** @dataProvider providerTestGetCanonical */
        public function testGetCanonical(string $address, $result)
        {
            $this->assertEquals($result, AddressValidator::getCanonicalAddress($address));
        }
    }
