<?php
class Security { 
    /**
     * Gera uma string randômica com tamanho pré-determinado
     *
     * @param string $length
     * @param string $publicKey
     * @return string
     */
    public static function genRandString($length = 0) {
        $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = '';
        $count = strlen($charset);
        while ($length-- > 0) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
		return $str;
    }
}