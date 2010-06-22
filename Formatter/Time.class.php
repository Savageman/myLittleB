<?php

/**
 * @author Savageman <savageman@zcorrecteurs.fr>
 * @package MLF
 */

class Time {

    public static $shortFormat  = 'HH:mm';
    public static $longFormat   = 'HH:mm:ss';

    public static $amSymbol     = '';
    public static $pmSymbol     = '';

    /**
     *
     * @param string $format Formatter string
     * @param int $hours hours, 24-hour format, example: date('g') or date('h')
     * @param int $minutes minutes, example: date('i')
     * @param int $seconds seconds, example: date('s')
     */
    public static function format($format, $hours, $minutes, $seconds) {
        $replaces = array(
            'HH'    => sprintf('%02d', $hours),
            'H'     => sprintf('%d', $hours),
            'hh'    => sprintf('%02d', $hours % 12),
            'h'     => sprintf('%d', $hours % 12),
            'mm'    => sprintf('%02d', $minutes),
            'm'     => sprintf('%d', $minutes),
            'ss'    => sprintf('%02d', $seconds),
            's'     => sprintf('%d', $seconds),
            'tt'    => $hours < 12 ? static::$amSymbol : static::$pmSymbol,
        );
        return str_replace(array_keys($replaces), array_values($replaces), $format);
    }

    public static function formatShort($hours, $minutes, $seconds) {
        return static::format(static::$shortFormat, $hours, $minutes, $seconds);
    }

    public static function formatLong($hours, $minutes, $seconds) {
        return static::format(static::$longFormat, $hours, $minutes, $seconds);
    }
}
