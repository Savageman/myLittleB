<?php

/**
 * @author Savageman <savageman@zcorrecteurs.fr>
 * @package MLF
 */

class Number {

    static $decimalSymbol       = ',';
    static $thousandSeparator   = '.';

    static $nbDigits        = 2;
    static $negativeSign    = '-';

    // %s = number
    static $positiveFormat  = '%s';
    static $negativeFormat  = '-%s';

    static function format($number) {

        $format = $number < 0 ? str_replace('-', static::$negativeSign, static::$negativeFormat) : static::$positiveFormat;
        return sprintf(
            $format,
            number_format(abs($number), static::$nbDigits, static::$decimalSymbol, static::$thousandSeparator)
        );
    }
}
