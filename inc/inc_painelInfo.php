<?php
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

<h2>Painel de Informações</h2>
<div id='box-importacao'>
	<?php 
	if (!empty($dados)):
	    foreach($dados as $reg):
			if ($_SESSION['PRIVILEGIO'] == "U"):
	?>
		    <p class='info'>
		        <span>Id do Processo:</span> <?php echo $reg->ID_OPERACAO ?><br/>
		        <span>Data/Hora: </span><?php echo $reg->DATA . ' - ' . $reg->HORA ?><br/>
		        <span>Quantidade de registro: </span><?php echo $reg->QTDE_REGISTRO ?>
		    </p>
	<?php 
			else:
	?>
			<p class='info'>
		        <span>Id do Processo:</span> <?php echo $reg->ID_OPERACAO ?><br/>
		        <span>Usuário:</span> <?php echo AlteraAcento($reg->RESPONSAVEL); ?><br/>
		        <span>Data/Hora: </span><?php echo $reg->DATA . ' - ' . $reg->HORA ?><br/>
		        <span>Quantidade de registro: </span><?php echo $reg->QTDE_REGISTRO ?>
		    </p>
	<?php
		endif;
    endforeach;
endif;
?>
</div>