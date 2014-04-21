<?php
session_start();
require_once './inc_verifica_acesso.php';
require_once 'autoload.php';

$conexao = Conexao::getInstance();
$usuario = new Usuario($conexao);
$dados   = $usuario->getAll();

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
            <?php include './inc_topo_interno.php';?>
        </div>
        
        <div id="corpo">
            <fieldset id="consultaUsuario">
                <h1>Consulta de Usuário</h1>
                <table class="tabela" align="center">
                    <thead>
                    <tr>
                        <th width="70">ID</th>
                        <th width="170">EMPRESA</th>
                        <th width="90">CNPJ</th>
                        <th width="150">RESPONSÁVEL</th>
                        <th width="150">FONE</th>
                        <th width="150">EMAIL</th>
                        <th width="50">STATUS</th>
                        <th>AÇÃO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados as $reg): ?>
                     <tr>
                        <td><?php echo $reg->ID_USUARIO; ?></td>
                        <td><?php echo $reg->RAZAO; ?></td>
                        <td><?php echo $reg->CNPJ; ?></td>
                        <td><?php echo $reg->RESPONSAVEL; ?></td>
                        <td><?php echo $reg->FONE; ?></td>
                        <td><?php echo $reg->EMAIL; ?></td>
                        <td><?php echo $reg->STATUS; ?></td>
                        <td>
                            <a href="editar/usuario/id/<?php echo $reg->ID_USUARIO; ?>"><img class="btnTabelaEI" src="images/editar.png" alt="Editar"></a>
                            <img class="btnTabelaEI" src="images/excluir.png" alt="Excluir" onclick="Confirma(<?php echo $reg->ID_USUARIO; ?>)"> 
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
                <br>
                <hr>
                <input type="image" class="btnImagem"src="images/btnIncluir.png" alt="Incluir" onclick="window.location='cadastrar-usuario'" title="Incluir Usuário"> 
                <input type="image" class="btnImagem"src="images/btnVoltar.png" alt="Voltar" onclick="window.location='principal'" title="Página principal">
            </fieldset>
        </div>
        <script type="text/javascript">
            function Confirma(id){
                var resp = confirm('Deseja excluir esse registro?');
                
                if(resp){
                    window.location = 'excluir/usuario/id/'+id;
                }
            }
        </script>    
    </body>
</html>
s