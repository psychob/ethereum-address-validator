Ethereum Address Validator
--
(c) by Andrzej Budzanowski <kontakt@andrzej.budzanowski.pl>

[![Maintainability](https://api.codeclimate.com/v1/badges/6ed9a66abca4f38be143/maintainability)](https://codeclimate.com/github/psychob/ethereum-address-validator/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/6ed9a66abca4f38be143/test_coverage)](https://codeclimate.com/github/psychob/ethereum-address-validator/test_coverage) [![Build Status](https://travis-ci.org/psychob/ethereum-address-validator.svg?branch=master)](https://travis-ci.org/psychob/ethereum-address-validator)

## License
MPL-2.0

## Brief
Class that verifies if [Ethereum](https://www.ethereum.org/) address is properly formatted and - optionaly - properly checksummed according to [EIP-55](https://github.com/ethereum/EIPs/blob/master/EIPS/eip-55.md).

## Installation
Use composer:

```bash
composer require psychob/ethereum-address-validator
```

## Usage
```php
<?php
    use \PsychoB\Ethereum\AddressValidator;
    
    // Addresses that have good format and checksum are considered valid
    AddressValidator::isValid('0xA477941c7AAD6536f175ef123bf9eeD6F82A4c85') === AddressValidator::ADDRESS_VALID;
    
    // Also addresses that are all uppercase or all lowercase are considered valid (no checksum check performed)
    AddressValidator::isValid('0xA477941C7AAD6536F175EF123BF9EED6F82A4C85') === AddressValidator::ADDRESS_VALID;
    AddressValidator::isValid('0xa477941c7aad6536f175ef123bf9eed6f82a4c85') === AddressValidator::ADDRESS_VALID;
    
    // Addresses that have good format but incorrect checksum
    AddressValidator::isValid('0xA477941c7aaD6536f175ef123bf9eeD6F82A4c85') === AddressValidator::ADDRESS_CHECKSUM_INVALID;
    
    // Address without proper format return
    AddressValidator::isValid('invalid address') === AddressValidator::ADDRESS_INVALID;
    
    // To get canonical (properly checksummed) addres, use:
    AddressValidator::getCanonicalAddress('0xA477941C7AAD6536F175EF123BF9EED6F82A4C85') === '0xA477941c7AAD6536f175ef123bf9eeD6F82A4c85'
```
