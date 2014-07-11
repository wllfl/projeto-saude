<?php
session_start();
require_once 'inc/inc_verifica_acesso.php';
require_once 'autoload.php';

$conexao = Conexao::getInstance();
$imp     = new Importacao($conexao);
$dados   = $imp->getFilterId($_SESSION['ID']);

$possuiDados = (empty($dados)) ? '0' : '1' ;
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Comentário -->
        <meta charset="UTF-8">
        <meta http-equiv='refresh' content='5; URL=/ProjetoPedro/principal'>
        <title>Principal</title>
        <link href="/ProjetoPedro/css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="geral">
            <div id="topo">
                <?php include 'inc/inc_topo_interno.php';?>
            </div>
            
            <div id="corpoPrincipal">
                <div id="painelInfo">
                    <?php include 'inc/inc_painelInfo.php';?> 
                </div>
               
                <div id="painelSecundario">
                    <a href="/ProjetoPedro/gerenciar-importacao">
                        <div id="cadastroUsuario" class="botoesPainel divBotoes">
                                <img class="imagemBotao" src="/ProjetoPedro/images/dados.png"></br>
                                <span class="rotuloBotao">Gerenciar Importações</span>
                        </div>
                    </a>

                    <a href="/ProjetoPedro/arquivo/PlanilhaDados.xlsx">
                        <div id="downloadPlanilha" class="botoesPainel divBotoes">
                                <img class="imagemBotao" src="/ProjetoPedro/images/download.png"></br>
                                <span class="rotuloBotao">Download Planilha</span>
                        </div>
                    </a>

                    <?php if ($_SESSION['PRIVILEGIO'] == "A"): ?>
                        <a href="/ProjetoPedro/pesquisar-usuario">
                            <div id="consultarUsuario" class="botaoLateral divBotoes">
                                    <img class="imagemBotao" src="/ProjetoPedro/images/lupa.png"></br>
                                    <span class="rotuloBotao">Consulta de Usuário</span>
                            </div>
                        </a>
                    <?php else: ?>
                        <a href="/ProjetoPedro/manual-usuario" target="_blank">
                            <div id="consultarUsuario" class="botaoLateral divBotoes">
                                    <img class="imagemBotao" src="/ProjetoPedro/images/help.png"></br>
                                    <span class="rotuloBotao">Manual do Usuário</span>
                            </div>
                        </a>
                    <?php endif; ?>
    		
    				<a href="#" onclick="VerificaDados()">
    					<div id="gerarGrafico" class="botoesPainel divBotoes">
    						<img class="imagemBotao" src="/ProjetoPedro/images/grafico.png"></br>
    						<span class="rotuloBotao">Gerar Gráfico</span>
    					</div>
    				</a>
    				
    				<a href="#" onclick="window.open('upload-planilha', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=600, HEIGHT=250');">
                        <div id="importarPlanilha" class="botoesPainel divBotoes">
                            <img class="imagemBotao" src="/ProjetoPedro/images/importar.png"></br>
                            <span class="rotuloBotao">Importar Planilha</span>
                        </div>
    				</a>

                    <a href="/ProjetoPedro/saude-ocupacional">
                        <div id="sobre" class="botaoLateral divBotoes">
                            <img class="imagemBotao" src="/ProjetoPedro/images/saudeOcupacional.png"></br>
                            <span class="rotuloBotao">Saúde Ocupacional</span>
                        </div>
                    <a/>
    				
                </div>
            </div>
            <div class="rodape">
                <?php include 'inc/inc_rodape.php';?>
            </div> 
        </div>  
        <script type="text/javascript">
        function VerificaDados(){
            var possuiDados = "<?php echo $possuiDados; ?>";

            if(possuiDados == '0'){
                alert('Você não possui importações!');
            }else{
                window.open('/ProjetoPedro/gerar-grafico', '_blank');
            }
        }
        </script>   
    </body>
</html>
