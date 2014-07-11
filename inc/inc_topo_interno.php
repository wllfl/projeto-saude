<?php
    require_once 'funcoes.php';
?>
<div id="titulo">
    <br>
    <div id="usuario">
        <a title="Usuário logado" href="/ProjetoPedro/consultar/usuario/id/<?php echo $_SESSION['ID']; ?>"><img src="/ProjetoPedro/images/usuario.png">
        <label class="labelUsuario">
        	<?php
        	    $usuario = ""; 
        		if (isset($_SESSION['RESPONSAVEL'])) :
        		    $usuario = substr($_SESSION['RESPONSAVEL'], 0, strpos($_SESSION['RESPONSAVEL'], " "));
        			if(empty($usuario)):
        				$usuario = $_SESSION['RESPONSAVEL'];
        			endif;
        		else: 
        		    $usuario = 'Usuário'; 
        		endif;
        		echo AlteraAcento($usuario);
        	?>
        </label></a>
        <img src="/ProjetoPedro/images/calendario.png" onclick="AtivaCalendario()" title="<?php echo getDataExtenso(); ?>"> <label class="labelUsuario" title="<?php echo getDataExtenso(); ?>"><?php echo date('d/m/Y'); ?>
        </label>
        <a href="/ProjetoPedro/login" title="Sair do sistema"><img src="/ProjetoPedro/images/exit.png"> <label class="lastLabel">Sair</label></a>                                
    </div>
    <a href="/ProjetoPedro/principal"><span class="TituloTopo">Ferramenta para Avaliação de Saúde Ocupacional</span></a>
</div>

