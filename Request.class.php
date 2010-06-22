<?php

/**
 * @author Savageman <savageman@zcorrecteurs.fr>
 * @package MLB
 */

/**
 * Provides some general information about the current Request
 * @class Request
 */
class Request {

    /**
     * Returns whether the current Request results from an Ajax call
     * @method isAjax()
     * @return boolean
     */
    public static function isAjax() {
        static $isAjax = null;
        if ($isAjax === null) {
            // X-Requested-With header should be XMLHttpRequest.
            $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])  == 'xmlhttprequest';
            // Remove COOKIE['ajax'] or GET['ajax']
        }
        return $isAjax;
    }

    /**
     * Returns whether the current Request is secured with https
     * @method isSecure()
     * @return boolean
     */
    public static function isSecure() {
        static $isSecure = null;
        if (null === $isSecure) {
            $isSecure = isset($_SERVER['HTTPS']) && (strtolower($_SERVER ['HTTPS']) == 'on' ||strtolower($_SERVER ['HTTPS']) == 1);
            $isSecure = $isSecure || (isset($_SERVER ['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER ['HTTP_X_FORWARDED_PROTO']) == 'https');
        }
        return $isSecure;
    }

    /**
     * Returns whether the current Request expects a JSON response
     * @method isAjax()
     * @return boolean
     */
    public static function jsonRequested() {
        static $jsonRequested = null;
        if ($jsonRequested === null) {
            // Http-Accept header should be application/json
            $jsonRequested = isset($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] == 'application/json';
        }
        return $jsonRequested;
    }
}
