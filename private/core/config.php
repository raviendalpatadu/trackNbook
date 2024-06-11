<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


define('ROOT', 'http://localhost/trackNbook/public/');
define('ASSETS', 'http://localhost/trackNbook/public/assets/');
define('PRIVATE_ASSETS', 'http://localhost/trackNbook/private/private_assets/');
define('APPROOT', dirname(dirname(__FILE__)));
// echo ROOT;

define('DBNAME' ,'tracknbook');// change this
define('DBHOST' ,'localhost');
define('DBUSER' ,'root');
define('DBPASS' ,'');
define('DBDRIVER' ,'mysql');

define('SITENAME', 'TrackNBook');
define('EMAIL', $_ENV['EMAIL']);
// get key from .env file

define('SMTP_HOST_EMAIL', $_ENV['SMTP_HOST_EMAIL']);
define('SMTP_PASSWORD', $_ENV['SMTP_PASSWORD']);


define ('MAP_API_KEY', $_ENV['MAP_API_KEY']);

define('MERCHENT_ID', $_ENV['MERCHENT_ID']);
define('PAYHERE_SECRET', $_ENV['PAY_HERE_SECRET']);


?>