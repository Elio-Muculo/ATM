<?php 

/**
 * Instancia conexao com Mysql Database
 */

 define("USER", "root");
 define("PASSWORD", "");

try {
    $conexao = new PDO("mysql:host=localhost;dbname=db_atm", USER, PASSWORD);
} catch (PDOException $th) {
    echo $th->getMessage();    
}

