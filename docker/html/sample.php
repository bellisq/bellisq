<?php 
phpinfo();
$PDO = new PDO('mysql:host=bellisq_mysql', 'root', 'pass', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
