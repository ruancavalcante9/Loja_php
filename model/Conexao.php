<?php
namespace model;
require_once "config.php";
use \PDO;
class Conexao{
    private $connection;

    public function getConnection(){
  $connection = new PDO(dsn, user, password);
  return $connection;
    }

}

?>