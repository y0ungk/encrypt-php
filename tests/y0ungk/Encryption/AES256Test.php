<?php

namespace y0ungk\Encryption\Tests;

use y0ungk\Encryption\Aes256;

class Aes256Test extends \PHPUnit_Framework_TestCase {
    public function testEncryption() {
        $aesKey = openssl_random_pseudo_bytes(Aes256::KEY_SIZE);
        $hmacKey = openssl_random_pseudo_bytes(Aes256::KEY_SIZE);
        $message = 'hello world';
        $encryptedMessage = Aes256::encrypt($message, $aesKey, $hmacKey);
        $decryptedMessage = Aes256::decrypt($encryptedMessage, $aesKey, $hmacKey);
        $this->assertEquals($message, $decryptedMessage);
    }
}