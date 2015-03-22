<?php
/**
 * PaQuRe ENCODING
 * @package   paqure
 * @version   0.0.1
 * @author    Roderic Linguri
 * @copyright Copyright (c) 2015, Linguri Technology
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace paqure;

/**
 * Encoding
 */
class Enc {

    /**
     * Encode an array into string
     * @param array
     * @return string
     */
    public static function enc($arr)
    {

        return base64_encode(serialize($arr));


    } // ./encode

    /**
     * Decode an encoded array back to an array
     * @param $str
     * @return mixed
     */
    public static function dec($str)
    {

        return unserialize(base64_decode($str));

    }

    /**
     * Encrypts a string
     * @param  string
     * @param  string (salt)
     * @return string (encrypted)
     */
    public static function ncr($str,$key)
    {

        $hsh = '';

        for ($i=0;$i<strlen($str);$i++) {

            $cha = substr($str,$i,1);
            $kch = substr($key, ($i % strlen($key))-1, 1);
            $och = ord($cha);
            $okc = ord($kch);
            $sum = $och + $okc;
            $cha = chr($sum);
            $hsh .= $cha;

        }

        $enc = base64_encode($hsh);

        return $enc;

    } // ./ncr()

    /**
     * Decrypts an encrypted string
     * @param  string (encrypted)
     * @param  string (salt)
     * @return string (decrypted)
     */
    public static function dcr($enc,$key)
    {

        $str = '';

        $hsh = base64_decode($enc);

        for ($i=0;$i<strlen($hsh);$i++) {

            $cha = substr($hsh,$i,1);
            $kch = substr($key, ($i % strlen($key))-1, 1);
            $och = ord($cha);
            $okc = ord($kch);
            $sum = $och - $okc;
            $cha = chr($sum);
            $str .= $cha;
        }

        return $str;

    } // ./dcr()

    /**
     * Sanitize
     * @param  string (dirty)
     * @return string (clean)
     */
    public static function san($arg)
    {

        return preg_replace('/\s+/', '\ ', addslashes($arg));

    } // ./Sanitize


    /**
     * Token
     * @return string (md5 token)
     */
    function tok() {

        return md5(microtime(false));

    }


} // ./Encoding