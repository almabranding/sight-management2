<?php

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('LIBS', 'libs/');
define('TEMPDIR', '/');
define('URL', 'http://' . $_SERVER['HTTP_HOST'] . TEMPDIR);
define('WEB', 'http://sight-management.com/');
define('PACKAGE', 'http://package.sight-management.com/');
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . TEMPDIR);
define('CACHE', ROOT . 'cache/');
define('UPLOAD', URL . 'uploads/');
define('VIDEOS', UPLOAD . 'videos/');
define('IMAGES', UPLOAD . 'images/');

$url = explode(".", $_SERVER['HTTP_HOST']);
$sumdomain = array_shift($url);
if(strtolower($sumdomain)=='www')
    $sumdomain = array_shift($url);
if (strtolower($sumdomain) == 'models') {
    $red = explode("/", $_SERVER['REQUEST_URI']);
    if (sizeof($red) == 2) {
        switch (strtolower($red[1])) {
            case 'men': header('location: ' . WEB . 'models/men');
                break;
            case 'women': header('location: ' . WEB . 'models/women');
                break;
            case 'sports': header('location: ' . WEB . 'models/sports');
                break;
            case 'development': header('location: ' . WEB . 'models/development');
                break;
            case 'special-bookings': header('location: ' . WEB . 'models/special_bookings');
                break;
            case 'models': header('location: ' . WEB . 'gallery/model/' . $red[2]);
                break;
            case 'packages': header('location: ' . PACKAGE . $red[2] . '/package');
                break;
        }
    } else {
        switch (strtolower($red[1])) {
            case 'packages': header('location: ' . PACKAGE . $red[2] . '/package');
                break;
            
            default: header('location: ' . WEB . 'gallery/model/' . $red[2]);
                break;
        }
    }
}
/*

  define('DB_TYPE', 'mysql');
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'sight');
  define('DB_USER', 'root');
  define('DB_PASS', 'root');
 */
// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');
define('NUMPP', 35);

