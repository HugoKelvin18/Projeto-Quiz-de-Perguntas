<?php
$host = 'localhost';
$dbname = 'sistema_perguntas';
$user = 'root';
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Erro na conexão: ".$e->getMessage();
    exit();
}

?>