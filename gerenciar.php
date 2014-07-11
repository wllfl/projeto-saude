<?php
session_start();
require_once 'inc/inc_verifica_acesso.php';
require_once 'autoload.php';
require_once 'funcoes.php';

$conexao = Conexao::getInstance();
$imp     = new Importacao($conexao);
if ($_SESSION['PRIVILEGIO'] == "U"):
    $dados   = $imp->getFilterId($_SESSION['ID']);
else:
    $dados   = $imp->getFilterId("");
endif;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Principal</title>
        <link href="/ProjetoPedro/css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="geral">  
            <div id="topo">
                <?php include 'inc/inc_topo_interno.php';?>
            </div>
            
            <div id="corpoGerenciaImp">
                <fieldset id="consultaUsuario">
                    <legend align="center">Gerenciar Importações</legend><br>
                    <table class="tabela" align="center">
                        <thead>
                        <tr>
                            <th width="170">OPERAÇÃO</th>
                            <th width="170">RAZÃO SOCIAL</th>
    						<th width="220">USUÁRIO</th>
                            <th width="90">REGISTROS</th>
                            <th width="150">DATA/HORA</th>
                            <th>AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
    					if(!empty($dados)):
    						foreach($dados as $reg): 
    					?>
    						 <tr>
    							<td><?php echo $reg->ID_OPERACAO; ?></td>
    							<td><?php echo $reg->RAZAO; ?></td>
    							<td><?php echo AlteraAcento($reg->RESPONSAVEL); ?></td>
    							<td><?php echo $reg->QTDE_REGISTRO; ?></td>
    							<td><?php echo $reg->DATA . ' - ' . $reg->HORA; ?></td>
    							<td>
    								<img class="btnTabelaEI" src="images/excluir.png" alt="Excluir" onclick="Confirma(<?php echo $reg->ID_OPERACAO; ?>)" title="Excluir registro"> 
    							</td>
    						</tr>
                        <?php 
    						endforeach;
    					endif;					
    					?>
                    </tbody>
                    </table>
                    <br>
                    <hr>
                    <input type="image" class="btnImagem"src="images/btnVoltar.png" alt="Voltar" onclick="window.location='principal'" title="Página principal">
                </fieldset>
            </div>
            <div class="rodape">
                <?php include 'inc/inc_rodape.php';?>
            </div> 
        </div>    
        <script type="text/javascript">
            function Confirma(id){
                var resp = confirm('Deseja excluir esse registro?');
                
                if(resp){
                    window.location = 'excluir/importacao/id/'+id;
                }
            }
        </script>    
    </body>
</html>