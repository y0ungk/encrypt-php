<?php

namespace y0ungk\Encryption\Tests;

use y0ungk\Encryption\Aes256;

class Aes256Test extends \PHPUnit_Framework_TestCase {
    public function testEncryption() {
        $aesKey = openssl_random_pseudo_bytes(Aes256::KEY_SIZE);
        $hmacKey = openssl_random_pseudo_bytes(Aes256::KEY_SIZE);
        $plainText = 'hello world';
        $encryption = new Aes256($aesKey, $hmacKey);
        $encryptedText = $encryption->encrypt($plainText);
        $decryptedText = $encryption->decrypt($encryptedText);
        $this->assertEquals($plainText, $decryptedText);
    }
}