<?php

/**
 * @author Savageman <savageman@zcorrecteurs.fr>
 * @package MLB
 */

/**
 * Some useful constants.
 * Copied from Hoa Framework.
 * @link http://hoa-project.net
 */
!defined('DS')              and define('DS'  , DIRECTORY_SEPARATOR);
!defined('PS')              and define('PS'  , PATH_SEPARATOR);
!defined('CRLF')            and define('CRLF', "\r\n");
!defined('PHP_VERSION_ID')  and $v = PHP_VERSION
                            and define('PHP_VERSION_ID',   $v{0} * 10000
                                                         + $v{2} * 100
                                                         + $v{4});

spl_autoload_register(function($className) {
    
    static $formatter = array('Currency','Date','Number','Time');

    if (in_array($className, $formatter)) {
        $file = 'Formatter'.DS."$className.class.php";
    } else {
        $file = "$className.class.php";
    }
    if (is_file(__DIR__.DS.$file)) {
        include __DIR__.DS.$file;
        return class_exists($className);
    }
    debug(__DIR__.DS.$file);
    return false;
});