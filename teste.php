<?php

require_once 'autoload.php';

$pdo = Conexao::getInstance();
$usuario = new Usuario($pdo);
$array = array(
    "HYPERMARCAS",
    "526341523/96",
    "11 4713-500",
    "JOAO VITOR",
    "joao@ig.com.br",
    "joao",
    base64_encode("123456"),
    "A"
);
var_dump(Usuario::validaUsuario('joao', '123456', $pdo));

