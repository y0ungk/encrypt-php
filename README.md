# PHP Encryption [![Build Status](https://travis-ci.org/y0ungk/php-encryption.svg?branch=master)](https://travis-ci.org/y0ungk/php-encryption)

Wrapper for encryption algorithms using PHP's [mcrypt](http://php.net/manual/en/book.mcrypt.php) library.

## Supported ciphers
 * AES 256 bit in CFB mode

## Usage

```php
    use y0ungk\Encryption\AES256;
    $aesKey = openssl_random_pseudo_bytes(AES256::KEY_SIZE);
    $hmacKey = openssl_random_pseudo_bytes(AES256::KEY_SIZE);
	$encryptor = new AES256($aesKey, $hmacKey);
    $encryptedMessage = $encryptor->encrypt($plaintext);
```

## Resources
 * http://php.net/manual/en/function.mcrypt-encrypt.php