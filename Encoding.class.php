<?php

/**
 * @author Savageman <savageman@zcorrecteurs.fr>
 * @package MLB
 */

class Encoding {

    /**
     * Apply recursively utf8_encode() on any variable
     * @param mixed $value reference
     */
    public static function utf8_decode_recursive(&$value) {
        if (is_array($value)) {
            self::utf8_decode_recursive($value);
        } else if (is_object($value)) {
            $vars = get_object_vars($value);
            foreach($vars as $k => $v) {
                $value->{$k} = self::utf8_decode_recursive($v);
            }
        } else if (is_string($value)) {
            $value = utf8_decode($value);
        }
    }

    /**
     * Apply recursively utf8_decode() on any variable
     * @param mixed $value reference
     */
    public static function utf8_encode_recursive(&$value) {
        if (is_array($value)) {
            self::utf8_encode_recursive($value);
        } else if (is_object($value)) {
            $vars = get_object_vars($value);
            foreach($vars as $k => $v) {
                $value->{$k} = self::utf8_encode_recursive($v);
            }
        } else if (is_string($value)) {
            $value = utf8_encode($value);
        }
    }

    /**
     * JSON encodes the variable using the latin1 charset
     * @param mixed $value
     * @return mixed
     * @see json_decode()
     */
    public static function json_encode_latin1($value) {
        self::utf8_encode_recursive($value);
        $value = json_encode($value);
        self::utf8_decode_recursive($value);
        return $value;
    }

    /**
     * JSON decodes the variable using the latin1 charset
     * @param mixed $value
     * @return mixed
     * @see json_decode()
     */
    public static function json_decode_latin1($value) {
        self::utf8_encode_recursive($value);
        $value = json_decode($value);
        self::utf8_decode_recursive($value);
        return $value;
    }
}