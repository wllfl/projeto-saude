<div id="titulo">
    <br>
    <div id="usuario">
        <img src="/ProjetoPedro/images/user.jpg"> <label class="labelUsuario"><?php echo (isset($_SESSION['RESPONSAVEL'])) ? substr($_SESSION['RESPONSAVEL'], 0, strpos($_SESSION['RESPONSAVEL'], " ")) : 'Usuario'; ?></label>  
        <img src="/ProjetoPedro/images/calendario.jpg"> <label class="labelUsuario"><?php echo date('d/m/Y'); ?></label> 
        <a href="/ProjetoPedro/login"><img src="/ProjetoPedro/images/sair.jpg"> <label class="lastLabel">Sair</label></a>                                
    </div>
    <span class="TituloTopo">Ferramenta para Avaliação de Saúde Ocupacional</span>
</div>
