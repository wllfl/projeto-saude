<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Comentário -->
        <meta charset="UTF-8">
        <title>Principal</title>
        <link href="/ProjetoPedro/css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="topo">
            <?php include './inc_topo_interno.php';?>
        </div>
        
        <div id="corpo">
            <div id="painelInfo">
                <h3>Painel de Informações</h3>
                <p> </p>
            </div>
           
            <div id="painelSecundario">
                <a href="/ProjetoPedro/cadastrar-usuario">
                    <div id="cadastroUsuario" class="botoesPainel divBotoes">
                            <img class="imagemBotao" src="/ProjetoPedro/images/user.jpg"></br>
                            <span class="rotuloBotao">Cadastro de Usuário</span>
                    </div>
                </a>

                <a href="/ProjetoPedro/pesquisar-usuario">
                    <div id="consultarUsuario" class="botoesPainel divBotoes">
                            <img class="imagemBotao" src="/ProjetoPedro/images/lupa.jpg"></br>
                            <span class="rotuloBotao">Consulta de Usuário</span>
                    </div>
                </a>

                <a href="/ProjetoPedro/arquivo/Planilha_Dados.xlsx">
                    <div id="downloadPlanilha" class="botaoLateral divBotoes">
                            <img class="imagemBotao" src="/ProjetoPedro/images/download.jpg"></br>
                            <span class="rotuloBotao">Download Planilha</span>
                    </div>
                </a>
				
                <div id="gerarGrafico" class="botoesPainel divBotoes">
                    <img class="imagemBotao" src="/ProjetoPedro/images/grafico.jpg"></br>
                    <span class="rotuloBotao">Gerar Gráfico</span>
                </div>
				
		<a href="#" onclick="window.open('importacao.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=600, HEIGHT=250');">
                    <div id="importarPlanilha" class="botoesPainel divBotoes">
                        <img class="imagemBotao" src="/ProjetoPedro/images/import.png"></br>
                        <span class="rotuloBotao">Importar Planilha</span>
                    </div>
		</a>
				
                <a href="/ProjetoPedro/saude-ocupacional">
                    <div id="sobre" class="botaoLateral divBotoes">
                        <img class="imagemBotao" src="/ProjetoPedro/images/saudeOcupacional2.png"></br>
                        <span class="rotuloBotao">Saúde Ocupacional</span>
                    </div>
               <a/>
            </div>
        </div>
            
    </body>
</html>
