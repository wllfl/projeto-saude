<html>
    <head>
        <meta charset="UTF-8">
        <title>Enviar senha</title>
        <link href="/ProjetoPedro/css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="topo">
            <?php include "inc/inc_topo_externo.php"; ?>
        </div>
        
        <fieldset class="box-mensagem">
            <h1>Enviar senha</h1>
            <label>Informe o e-mail que consta em nossos cadastros: </label></br>
            <input type="text" name="email" id="email" class="input" placeholder="Informe o e-mail">
            </br>
            </br>
            <input type="image" name="botao" src="/ProjetoPedro/images/btnVoltar.png" class="btnImagem" alt="Voltar" onclick="window.location='/ProjetoPedro/login'">
            <input type="image" name="botao" src="/ProjetoPedro/images/btnEnviar.png" class="btnImagem" alt="Enviar">
        </fieldset>
    </body>
</html>


