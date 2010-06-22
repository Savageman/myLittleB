<?php

/**
 * @author Savageman <savageman@zcorrecteurs.fr>
 * @package MLB
 */

/**
 * Stores all the information needed to generate the current Page
 */
class Page {

    public static $pageTitle        = '';
    public static $metaCharset      = 'utf-8';

    public static $jsFiles            = array();
    public static $cssFiles            = array();
    public static $rssFeeds            = array();

    public static $metaKeywords        = array();
    public static $metaDescription    = '';

    public static $robots            = 'index,follow';
}
