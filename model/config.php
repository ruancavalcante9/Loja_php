<?php

$host = "localhost";
$user = "root";
$password = "ruan123";
$dbname = "loja_php";
$dsn = "mysql:host=$host;dbname=$dbname;";
$options    = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  );
  
//cria uma constante que pode ser acessada 
define("dsn", $dsn);
define("user", $user);
define("password", "$password"); 
define("options", $options);

?>