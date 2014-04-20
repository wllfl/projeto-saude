<?php
require_once "autoload.php";

$pdo = Conexao::getInstance();
$user = new Usuario($pdo);
$array = array(
    "AXO",
    "3525263000",
    "4152-6352",
    "WILLIAM",
    "wllfl@gmail.com",
    base64_encode("123456"),
    "A"
);

var_dump($user->insert($array));


