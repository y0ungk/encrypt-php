<?php

class AES256Test extends PHPUnit_Framework_TestCase {
    public function testEncryption() {
        $aesKey = openssl_random_pseudo_bytes(AES256::KEY_SIZE);
        $hmacKey = openssl_random_pseudo_bytes(AES256::KEY_SIZE);
        $message = 'hello world';
        $encryptedMessage = AES256::encrypt($message, $aesKey, $hmacKey);
        $decryptedMessage = AES256::decrypt($encryptedMessage, $aesKey, $hmacKey);
        $this->assertEquals($message, $decryptedMessage);
    }
}