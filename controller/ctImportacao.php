<?php
session_start();
require_once "../config.php";
require_once PATH . "/autoload.php";

$planilha = new Planilha(Conexao::getInstance(), $_FILES['file']['tmp_name'], 'TAB_PLANILHA');
if($planilha->insertDados()):
	echo "<script>alert('Importação realizada com sucesso!')</script>";
else:
	echo "<script>alert('Erro ao realizar Importação!')</script>";
endif;
echo "<script>window.close();</script>";  

