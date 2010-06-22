<?php

/**
 * @author Savageman <savageman@zcorrecteurs.fr>
 * @package MLB
 */

class File {
    /**
     *
     * @param string $filename
     * @return mixed
     * @see finfo_file()
     * @see mime_content_type()
     */
    public static function getContentType($filename) {
        if (PHP_VERSION_ID >= 50300 && defined('FILEINFO_MIME')) {
            $finfo = new finfo(FILEINFO_MIME);
            return $finfo->file($filename);
        } else {
            return mime_content_type($filename);
        }
    }
}
