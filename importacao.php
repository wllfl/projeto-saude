<?php
header('Content-type: text/html; charset=utf-8');
session_start();
require_once 'inc/inc_verifica_acesso.php';
require_once 'autoload.php';

$pdo = Conexao::getInstance();
$importacao = new Importacao($pdo);

if ($importacao->getContadorImportacao($_SESSION['ID']) >= 12):
    echo "<script>alert('Seu limite de 12 importações foi atingido! O sistema irá excluir a importação mais antiga.')</script>";
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
        <fieldset id="boxImportacao"> 
            <legend align="center">Importar Planilha</legend>
            <form name="frmImportacao" id="frmImportacao" method="POST" action="/ProjetoPedro/controller/ctImportacao.php?acao=importar" enctype="multipart/form-data"/>
                <input type="file" name="file" id="file" title="Importar arquivo"></br></br>
            </form>
            <input type="image" name="botaoVoltar" src="/ProjetoPedro/images/fechar.png" class="btnImagem" onclick="window.close();" title="Página principal"/>
            <input type="image" name="botaoImportar" src="/ProjetoPedro/images/btnImportar.png" class="btnImagem" onclick="Submit();" title="Importar" /> 
        </fieldset>
        <script type="text/javascript">
            function Submit(){
                var form = document.getElementById('frmImportacao');
                form.submit();
            }
        </script>
    </body>
</html>
