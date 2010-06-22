<?php

/**
 * @author Savageman <savageman@zcorrecteurs.fr>
 * @package MLB
 */

class Compat {

    /**
     * Reverts magic_quotes_gpc and disables magic_quotes_runtime
     * @return void
     * @uses self::removeMagicQuotesGpc()
     */
    public static function MagicQuotes() {
        if(PHP_VERSION_ID < 50300) { // PHP < 5.3.0
            ini_set('magic_quotes_runtime', 0);
            set_magic_quotes_runtime(0);
        }

        if(1 == get_magic_quotes_gpc()) {
            self::removeMagicQuotesGpc($_GET);
            self::removeMagicQuotesGpc($_POST);
            self::removeMagicQuotesGpc($_COOKIE);
        }
    }


    /**
     * Strip recursively the slashes added by magic_quotes_gpc on any variable
     * @internal
     * @param mixed $value reference
     * @uses stripslashes()
     */
    protected static function removeMagicQuotesGpc(&$value) {
        if (is_array($value)) {
            foreach($value as &$v) {
                self::removeMagicQuotesGpc($v);
            }
        } elseif (is_string($value)) {
            $value = stripslashes($value);
        } else {
            $value = $value;
        }
    }
}
?>
