Ethereum Address Validator
==========================

Simple class that can be used to validate if Ethereum Address is a valid one, can also generate proper canonical 
(checksumed) form from address.

## Requirements

- PHP 7.1 and above

## Steps:

* [Installation](#installation)
* [Usage](#usage)
* [Maintainers](#maintainers)
* [License](#license)


### Installation

**Composer**

Run the following command to include this package via Composer

```shell
    composer require psychob/ethereum-address-validator
```

### Usage
Simple to use.

- Check if string is Ethereum or Ethereum Classic address

```php
   use PsychoB\Ethereum\AddressValidator;
	 
   $address = 'Ethereum Address';
   
   if(AddressValidator::isValid($address) == 0){
      //String is a valid Ethereum or Etherum Classic address.
   }
   
   if(AddressValidator::isValid($address) == 1){
      //String have valid address, but capitalization is incorrect.
   }
   
   if(AddressValidator::isValid($address) == 2){
      //String is not an Ethereum or Ethereum Classic address.
   }
```


- Generate address with checksum from non-checksumed address.

```php
  
    $address = 'Ethereum Address';
    
    $payload = AddressValidator::getCanonicalAddress($address);
    
```


### Maintainers

This package is maintained by [Andrzej Budzanowski](https://github.com/psychob), [David Oti](http://github.com/davmixcool) and you!


### License

This package is licensed under the [Mozilla Public License](https://github.com/psychob/ethereum-address-validator/blob/master/LICENSE).
