<?php

define('TIME_ZONE', 'Europe/Paris');
setlocale (LC_ALL, 'fr_FR.utf8','fr_FR', 'fr'); 

// Use of url rewriting
//define('URL_REWRITING', false);
define('URL_REWRITING', 'app');

define('DEBUG',true);

define('DSN_PDO_MYSQL', 'mysql:host=localhost;dbname=dev');
define('MYSQL_USER', 'admin');
define('MYSQL_PASSWORD', 'ohlol');
?>
