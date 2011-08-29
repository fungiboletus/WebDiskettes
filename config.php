<?php

define('TIME_ZONE', 'Europe/Paris');
setlocale (LC_ALL, 'fr_FR.utf8','fr_FR', 'fr'); 

// Use of url rewriting
define('URL_REWRITING', 'app');
//define('URL_REWRITING', false);

define('DEBUG',true);

// Size of a 1.44 Mio diskette
define('MAX_FILESIZE', 1457000);

define('DSN_PDO_MYSQL', 'mysql:host=localhost;dbname=dev');
define('MYSQL_USER', 'admin');
define('MYSQL_PASSWORD', 'ohlol');
?>
