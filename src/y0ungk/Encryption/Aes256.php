<?php

namespace y0ungk\Encryption;

class Aes256 {
    const KEY_SIZE = 32;
    const SIG_SIZE = 32;

    private $aesKey;
    private $hmacKey;

    public function __construct($aesKey, $hmacKey) {
        $this->aesKey = $aesKey;
        $this->hmacKey = $hmacKey;
    }

    public function encrypt($plaintext) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CFB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        // prepend iv to be used for decryption
        $encrypted = $iv . mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->aesKey, $plaintext, MCRYPT_MODE_CFB, $iv);
        $digest = hash_hmac("sha256", $encrypted, $this->hmacKey, true);
        return base64_encode($encrypted . $digest);
    }

    public function decrypt($message) {
        $bits = base64_decode($message);
        $iv = substr($bits, 0, self::KEY_SIZE);
        $digest = substr($bits, -self::SIG_SIZE);
        $cryptotext = substr($bits, self::KEY_SIZE, -self::SIG_SIZE);

        $decrypted = null;
        if ($digest == hash_hmac("sha256", $iv . $cryptotext, $this->hmacKey, true)) {
            $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->aesKey, $cryptotext, MCRYPT_MODE_CFB, $iv);
        }
        // sometimes mcrypt_decrypt will append nulls
        return rtrim($decrypted, "\0");
    }

}