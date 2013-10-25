<?php
// Always provide a TRAILING SLASH (/) AFTER A PATH
define('LIBS', 'libs/');
define('TEMPDIR', '/');
define('URL', 'http://package.sight-management.com/');
define('WEB', 'http://sight-management.com/');
define('ROOT', $_SERVER['DOCUMENT_ROOT'].TEMPDIR.'package/');
define('CACHE', ROOT.'../cache/');
$url=explode("package.",$_SERVER['HTTP_HOST']);
array_shift($url);
define('SIGHT', 'http://'.$url[0]); 

$url=explode(".",$_SERVER['HTTP_HOST']);
$sumdomain=array_shift($url);
switch($sumdomain){
    case 'models':
        $red=explode("/",$_SERVER['REQUEST_URI']);
        header('location: '.WEB.'gallery/model/'.$red[2]);
}

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sightdb');
define('DB_USER', 'mysightma');
define('DB_PASS', '4G91Fn8Y');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');
define('NUMPP',35);
define('UPLOAD_ABS', URL.'../uploads/');
define('UPLOAD', SIGHT.'/uploads/');
define('UPLOADMODELS', '../uploads/models/');
@session_start();

