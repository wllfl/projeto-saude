<!DOCTYPE html>
<html>
    <head>
        <!-- Comentário -->
        <meta charset="UTF-8">
        <title>Principal</title>
        <link href="css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="topo">
            <div id="titulo">
			    <br>
                <div id="usuario">
                    <img src="images/user.jpg"> <label class="labelUsuario">Usuário</label>  
                    <img src="images/calendario.jpg"> <label class="labelUsuario">10/04/2014</label> 
                    <img src="images/sair.jpg"> <label class="lastLabel">Sair</label>                                  
                </div>
				<span class="TituloTopo">Ferramenta para Avaliação de Saúde Ocupacional</span>
            </div>
        </div>
        
        <div id="corpo">
            <div id="painelInfo">
                <h3>Painel de Informações</h3>
                <p> </p>
            </div>
           
            <div id="painelSecundario">
			    <a href="cadastrar-usuario">
					<div id="cadastroUsuario" class="botoesPainel divBotoes">
						<img class="imagemBotao" src="images/user.jpg"></br>
						<span class="rotuloBotao">Cadastro de Usuário</span>
					</div>
				</a>
				
				<a href="pesquisar-usuario">
					<div id="consultaUsuario" class="botoesPainel divBotoes">
						<img class="imagemBotao" src="images/lupa.jpg"></br>
						<span class="rotuloBotao">Consulta de Usuário</span>
					</div>
				</a>
				
				<a href="arquivo/Planilha_Dados.xlsx">
					<div id="downloadPlanilha" class="botaoLateral divBotoes">
						<img class="imagemBotao" src="images/download.jpg"></br>
						<span class="rotuloBotao">Download Planilha</span>
					</div>
				</a>
				
                <div id="gerarGrafico" class="botoesPainel divBotoes">
                    <img class="imagemBotao" src="images/grafico.jpg"></br>
                    <span class="rotuloBotao">Gerar Gráfico</span>
                </div>
				
		<a href="#" onclick="window.open('importacao.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=600, HEIGHT=300');">
                <div id="importarPlanilha" class="botoesPainel divBotoes">
                    <img class="imagemBotao" src="images/import.png"></br>
                    <span class="rotuloBotao">Importar Planilha</span>
                </div>
				</a>
				
                                        <a href="sobre.php">
					<div id="sobre" class="botaoLateral divBotoes">
						<img class="imagemBotao" src="images/saudeOcupacional2.png"></br>
						<span class="rotuloBotao">Saúde Ocupacional</span>
					</div>
				<a/>
            </div>
        </div>
            
    </body>
</html>
