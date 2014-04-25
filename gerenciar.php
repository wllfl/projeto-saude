<?php
session_start();
require_once 'inc/inc_verifica_acesso.php';
require_once 'autoload.php';

$conexao = Conexao::getInstance();
$imp     = new Importacao($conexao);
$dados   = $imp->getFilterId($_SESSION['ID']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Principal</title>
        <link href="css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="topo">
            <?php include 'inc/inc_topo_interno.php';?>
        </div>
        
        <div id="corpo">
            <fieldset id="consultaUsuario">
                <h1>Gerenciar Importações</h1>
                <table class="tabela" align="center">
                    <thead>
                    <tr>
                        <th width="70">ID</th>
                        <th width="170">OPERAÇÃO</th>
						<th width="220">USUÁRIO</th>
                        <th width="90">REGISTROS</th>
                        <th width="150">DATA/HORA</th>
                        <th>AÇÃO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados as $reg): ?>
                     <tr>
                        <td><?php echo $reg->ID_IMPORTACAO; ?></td>
                        <td><?php echo $reg->ID_OPERACAO; ?></td>
						<td><?php echo $reg->RESPONSAVEL; ?></td>
                        <td><?php echo $reg->QTDE_REGISTRO; ?></td>
                        <td><?php echo $reg->DATA . ' - ' . $reg->HORA; ?></td>
                        <td>
                            <img class="btnTabelaEI" src="images/excluir.png" alt="Excluir" onclick="Confirma(<?php echo $reg->ID_OPERACAO; ?>)" title="Excluir registro"> 
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
                <br>
                <hr>
                <input type="image" class="btnImagem"src="images/btnVoltar.png" alt="Voltar" onclick="window.location='principal'" title="Página principal">
            </fieldset>
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
s