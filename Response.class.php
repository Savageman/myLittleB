<?php

/**
 * @author Savageman <savageman@zcorrecteurs.fr>
 * @package MLB
 */
class Response {

    const Status_Moved_Permanently         = 301;
    const Status_Moved_Temporarily         = 302;
    const Status_Authorization_Required    = 401;
    const Status_Forbidden                 = 403;
    const Status_Not_Found                 = 404;

    /**
     * Redirects the user to the same page on the specified domain
     * @param string $domain
     * @uses $_SERVER['HTTP_HOST']
     * @uses $_SERVER['REQUEST_URI']
     */
    public static function redirectDomain($domain, $httpResponseCode = null) {
        if ($_SERVER['HTTP_HOST'] != $domain) {
            $scheme = Request::isSecure() ? 'https://' : 'http://';
            self::redirect($scheme.$domain.$_SERVER['REQUEST_URI'], $httpResponseCode);
        }
    }

    /**
     * Disposition of the ressource is attachment (the browser will ask for download).
     * Meant to be used just before self::sendFile()
     * @param string $filename
     */
    public static function forceDownload($filename) {
        header('Content-Disposition: attachment; filename="'.$filename.'"');
    }

    /**
     * Disposition of the ressource is inline (the browser will use his default behavior).
     * Meant to be used just before self::sendFile()
     * @param string $filename
     */
    public static function forceInline($filename) {
        header('Content-Disposition: inline; filename="'.$filename.'"');
    }

    /**
     * @param string $filename A file accessible on the system
     * @param string $contentType optional Forces the specified content type, e.g. text/plain. Default tries to guess the best content type
     * @uses File::getContentType()
     */
    public function sendFile($filename, $contentType = null) {
        if (null == $contentType) {
            $contentType = File::getContentType($filename);
        }
        header("Content-Type: $contentType");
        // header('Content-Description: File Transfer');
        // header('Content-Transfer-Encoding: binary');
        readfile($filename);
        exit();
    }

    /**
     * Redirects the current request with a 302 HTTP status code: Moved Temporarily
     * @param string $location
     * @param int $httpResponseCode
     * @return void
     * @uses Request::isAjax()
     * @uses $_SERVER['SERVER_PROTOCOL']
     */
    public static function redirect($location, $httpResponseCode = null) {
        if (Request::isAjax()) {
            // Ajout COOKIE['ajax'] ou GET['ajax']
        }
        if (null === $httpResponseCode) {
            if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
                $httpResponseCode = 303; // See Other
            } else {
                $httpResponseCode = 302; // Moved Temporarly / Found
            }
        }
        header("Location: $location", true, $httpResponseCode);
        exit();
    }

    /**
     * Sends the specified HTTP status code
     * @param <type> $httpResponseCode
     * @return void
     */
    public function statusCode($httpResponseCode) {
        // @link http://gif.phpnet.org/frederic/programs/http_status_codes/
        header('x', true, $httpResponseCode);
    }
}
