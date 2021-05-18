<?php
class Crypto
{
    # Private key
    public static $salt = 'Lu70K$i3pu5xf7*I8tNmd@x2oODwwDRr4&xjuyTh';

    /**
     * Criptografa uma string utilizando Cifra de César
     *
     * @param string $str
     * @param integger $shift
     * @param boolean $backwards
     * @return string
     */
    public function encryptCaesarCipher($str = '', $shift = 4, $backwards = false)
    {
        $encrypted_str = '';
        $uppercaseMaxBoundry = (!$backwards)?90:65;
        $uppercaseMaxBoundry = (!$backwards)?65:90;

        $lowercaseMaxBondry = (!$backwards)?122:97;
        $lowercaseMinBondry = (!$backwards)?97:122;
        for ($i=0; $i<strlen($str); $i++) {

            $ascii = ord(substr($str, $i, 1));
            for($j=0; $j<$shift; $j++){
                if($ascii == $uppercaseMaxBoundry) {
                    $ascii = $uppercaseMaxBoundry;
                } else if($ascii == $lowercaseMaxBondry) {
                    $ascii = $lowercaseMinBondry;
                } else {
                    if (($ascii >= 65 && $ascii <= 90) || ($ascii >= 97 && $ascii <= 122)) {
                        if (!$backwards) {
                            $ascii++;
                        } else {
                            $ascii--;
                        }
                    }
                }
            }
            $encrypted_str .= chr($ascii);

        }
        return $encrypted_str;

    }

    /**
     * Criptografa uma string utilizando AES256
     *
     * @param string $str
     * @param string $publicKey
     * @return string
     */
    public function encryptAes256($str = '', $publicKey = '')
    {

        $key = substr(hash('sha256', $publicKey . self::$salt), 0, 32); # Generate the encryption and hmac key
 
        $algorithm = MCRYPT_RIJNDAEL_128; # encryption algorithm
        $mode = MCRYPT_MODE_CBC; # encryption mode
 
        $ivSize = mcrypt_get_iv_size($algorithm, $mode); # Returns the size of the IV belonging to a specific cipher/mode combination
        $iv = mcrypt_create_iv($ivSize, MCRYPT_DEV_URANDOM); # Creates an initialization vector (IV) from a random source
        $ciphertext = $iv . mcrypt_encrypt($algorithm, $key, $str, $mode, $iv); # Encrypts plaintext with given parameters
        $hmac = hash_hmac('sha256', $ciphertext, $key); # Generate a keyed hash value using the HMAC method
        return $hmac . $ciphertext;
    }

    /**
     * Descriptografa uma cifra utilizando Cifra de César
     *
     * @param string $str
     * @param integer $shift
     * @return string
     */
    public function decryptCaesarCipher($str = '', $shift = 4)
    {
        return $this->encryptCaesarCipher($str, $shift, true);
    }

    /**
     * Descriptografa uma cifra utilizando AES256
     *
     * @param string $cipher
     * @param string $publicKey
     * @return string
     */
    public function decryptAes256($cipher = '', $publicKey = '')
    {
        $key = substr(hash('sha256', $publicKey . self::$salt), 0, 32); # Generate the encryption and hmac key.
 
        # Split out hmac for comparison
        $macSize = 64;
        $hmac = substr($cipher, 0, $macSize);
        $cipher = substr($cipher, $macSize);
 
        $compareHmac = hash_hmac('sha256', $cipher, $key);
        if ($hmac !== $compareHmac) {
            return false;
        }
 
        $algorithm = MCRYPT_RIJNDAEL_128; # encryption algorithm
        $mode = MCRYPT_MODE_CBC; # encryption mode
        $ivSize = mcrypt_get_iv_size($algorithm, $mode); # Returns the size of the IV belonging to a specific cipher/mode combination
 
        $iv = substr($cipher, 0, $ivSize);
        $cipher = substr($cipher, $ivSize);
        $plain = mcrypt_decrypt($algorithm, $key, $cipher, $mode, $iv);
        return rtrim($plain, "\0");
    }
}