<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Importação de Planilha</title>
        <link href="/ProjetoPedro/css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <form action="" method="">
            <fieldset id="boxImportacao"> 
                <legend align="center">Importar Planilha</legend>
                <input type="file" name="file" id="file"></br></br>
                <input type="image" name="botaoVoltar" src="/ProjetoPedro/images/btnVoltar.png" class="btnImagem" onclick="window.close();"/>
                <input type="image" name="botaoImportar" src="/ProjetoPedro/images/btnImportar.png" class="btnImagem">                   
            </fieldset>
        </form>
    </body>
</html>
