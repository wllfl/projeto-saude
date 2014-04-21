<?php
session_start();
require_once './inc_verifica_acesso.php';

if (isset($_FILES['file'])):
var_dump($_FILES['file']);
echo move_uploaded_file($_FILES['file']['tmp_name'], "planilhas/planilha.xls");
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
            <form name="frmImportacao" id="frmImportacao" method="POST" action="" enctype="multipart/form-data"/>
                <input type="file" name="file" id="file"></br></br>
            </form>
            <input type="image" name="botaoVoltar" src="/ProjetoPedro/images/btnVoltar.png" class="btnImagem" onclick="window.close();"/>
            <input type="image" name="botaoImportar" src="/ProjetoPedro/images/btnImportar.png" class="btnImagem" onclick="Submit()"> 
        </fieldset>
        <script type="text/javascript">
            function Submit(){
                var form = document.getElementById('frmImportacao');
                form.submit();
            }
        </script>
    </body>
</html>
