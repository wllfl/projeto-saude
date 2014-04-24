<?php
session_start();
require_once 'inc/inc_verifica_acesso.php';
require_once 'autoload.php';

$sql = "SELECT * FROM TAB_IMPORTACAO ORDER BY ID_IMPORTACAO ASC";
$pdo = Conexao::getInstance();
$stm = $pdo->prepare($sql);
$stm->execute();
$dados = $stm->fetchAll(PDO::FETCH_OBJ);

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
            <?php include 'inc/inc_topo_interno.php';?>
        </div>
        
        <div id="corpo">
            <div id="painelInfo">
                <h2>Painel de Informações</h2>
                <?php foreach($dados as $reg):?>
                <p class='info'>
                    <span>Id do Processo:</span> <?php echo $reg->ID_OPERACAO ?><br/>
                    <span>Data/Hora: </span><?php echo $reg->DATA_IMPORTACAO ?><br/>
                    <span>Quantidade de registro: </span><?php echo $reg->QTDE_REGISTRO ?>
                </p>
                <br>
            <?php endforeach;?>
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

                <a href="/ProjetoPedro/arquivo/PlanilhaDados.xlsx">
                    <div id="downloadPlanilha" class="botaoLateral divBotoes">
                            <img class="imagemBotao" src="/ProjetoPedro/images/download.jpg"></br>
                            <span class="rotuloBotao">Download Planilha</span>
                    </div>
                </a>
		
		<a href="/ProjetoPedro/gerar-grafico" target="_blank">		
		        <div id="gerarGrafico" class="botoesPainel divBotoes">
		            <img class="imagemBotao" src="/ProjetoPedro/images/grafico.jpg"></br>
		            <span class="rotuloBotao">Gerar Gráfico</span>
		        </div>
		</a>
				
				<a href="#" onclick="window.open('upload-planilha', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=600, HEIGHT=250');">
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
