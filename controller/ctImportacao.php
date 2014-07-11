<?php
header('Content-type: text/html; charset=utf-8');
session_start();
require_once "../config.php";
require_once PATH . "/autoload.php";
$acao    = (isset($_REQUEST['acao'])) ? $_REQUEST['acao'] : '' ;
$id      = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : '' ;
$conexao = Conexao::getInstance();

if ($acao == 'excluir'):
	if (!empty($id)):
	   $imp     = new Importacao($conexao);
       $retorno = $imp->delete($id);

       if ($retorno):
            echo "<script>alert('Registro excluído com sucesso!')</script>";
       else:    
            echo "<script>alert('Erro ao excluir registro!')</script>";
       endif;
       
       echo "<script>window.location='/ProjetoPedro/gerenciar-importacao'</script>";
    endif;
endif;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Importação de Planilha</title>
        <link href="/ProjetoPedro/css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
		<?php
		if ($acao == 'importar'):
			$planilha = new Planilha(Conexao::getInstance(), $_FILES['file']['tmp_name'], 'TAB_PLANILHA', $_FILES['file']['name']);
			if($planilha->insertDados()):
				echo "<script>alert('Importação realizada com sucesso!')</script>";
			else:
				echo "<script>alert('Erro ao realizar Importação!')</script>";
			endif;
			echo "<script>window.close();</script>";  
		endif;
		?>
    </body>
</html>
