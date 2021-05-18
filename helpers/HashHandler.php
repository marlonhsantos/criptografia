<?php
class HashHandler
{
    /**
     * Gera um hash utilizando método SHA512
     *
     * @param string $str
     * @param string $salt
     * @return string
     */
    public function generateSha512($str = '', $salt = 'HkYgJ28LSn84bYpX')
    {
        if (CRYPT_SHA512 == 1) {
            return crypt($str, '$6$rounds=5000$'.$salt.'$');
        } else {
            return false;
        }
    }

    /**
     * Gera um hash utilizando método HMAC
     *
     * @param string $str
     * @param string $key
     * @return string
     */
    public function generateHmac($str = '', $key = 'secret')
    {
        return hash_hmac('sha512', $str, $key);
    }

    /**
     * Realiza a comparação entre dois hashes
     *
     * @return boolean
     */
    public function hashEquals($str1 = '', $str2 = '')
    {
        return hash_equals($str1, $str2);
    }
}