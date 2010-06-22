<?php

/**
 * @author Savageman <savageman@zcorrecteurs.fr>
 * @package MLB
 */

class Currency {
    
    static $currencySymbol      = '€';
    static $decimalSymbol       = ',';
    static $thousandSeparator   = '.';
    
    static $nbDigits        = 2;

    // %1$s = number
    // %2$s = currency symbol
    static $positiveFormat  = '%1$s %2$s';
    static $negativeFormat  = '-%1$s %2$s';

    static function format($number) {

        $format = $number < 0 ? static::$negativeFormat : static::$positiveFormat;
        return sprintf(
            $format,
            number_format(abs($number), static::$nbDigits, static::$decimalSymbol, static::$thousandSeparator),
            static::$currencySymbol
        );
    }
}
