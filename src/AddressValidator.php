<?php
    //
    // psychob/ethereum-address-validator
    // (c) 2018 - 2019 RGB Lighthouse <https://rgblighthouse.pl>
    // (c) 2018 - 2019 Andrzej Budzanowski <kontakt@andrzej.budzanowski.pl>
    // --
    // See LICENSE for license information.
    //

    namespace PsychoB\Ethereum;

    use kornrunner\Keccak;

    class AddressValidator
    {
        /**
         * String is a valid Ethereum or Etherum Classic address
         */
        public const ADDRESS_VALID = 0;

        /**
         * String have valid address, but capitalization is incorrect.
         */
        public const ADDRESS_CHECKSUM_INVALID = 1;

        /**
         * String is not an Ethereum or Ethereum Classic address
         */
        public const ADDRESS_INVALID = 2;

        /**
         * Check if string is Ethereum or Ethereum Classic address
         *
         * @param string $address
         *
         * @return int
         */
        public static function isValid(string $address): int
        {
            if (!preg_match('/^0x[a-fA-F0-9]{40}$/', $address)) {
                return self::ADDRESS_INVALID;
            }

            if (preg_match('/^0x[a-f0-9]{40}$/', $address) || preg_match('/^0x[A-F0-9]{40}$/', $address)) {
                return self::ADDRESS_VALID;
            }

            return self::validateChecksumAddress(substr($address, 2));
        }

        private static function validateChecksumAddress($address): int
        {
            $addressHash = Keccak::hash(strtolower($address), 256);
            $addressArray = str_split($address);
            $addressHashArray = str_split($addressHash);

            for ($i = 0; $i < 40; $i++) {
                // the nth letter should be uppercase if the nth digit of casemap is 1
                if ((intval($addressHashArray[$i], 16) > 7 && strtoupper($addressArray[$i]) !== $addressArray[$i]) ||
                    (intval($addressHashArray[$i], 16) <= 7 && strtolower($addressArray[$i]) !== $addressArray[$i])) {
                    return self::ADDRESS_CHECKSUM_INVALID;
                }
            }

            return self::ADDRESS_VALID;
        }

        /**
         * Generate address with checksum from non-checksumed address.
         *
         * @param string $address
         *
         * @return string|null
         */
        public static function getCanonicalAddress(string $address): ?string
        {
            if (!preg_match('/^0x[a-fA-F0-9]{40}$/', $address)) {
                return NULL;
            }

            $address = substr($address, 2);
            $addressHash = Keccak::hash(strtolower($address), 256);
            $addressArray = str_split($address);
            $addressHashArray = str_split($addressHash);

            $ret = '';

            for ($i = 0; $i < 40; $i++) {
                // the nth letter should be uppercase if the nth digit of casemap is 1
                if (intval($addressHashArray[$i], 16) > 7) {
                    $ret .= strtoupper($addressArray[$i]);
                } else /*if (intval($addressHashArray[$i], 16) <= 7)*/ {
                    $ret .= strtolower($addressArray[$i]);
                }
            }

            return '0x' . $ret;
        }
    }
