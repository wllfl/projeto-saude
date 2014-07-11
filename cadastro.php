<?php
session_start();
require_once 'inc/inc_verifica_acesso.php';
require_once 'autoload.php';
require_once 'funcoes.php';

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id']:'';

if (!empty($id)):
    $conexao = Conexao::getInstance();
    $usuario = new Usuario($conexao);
    $dados   = $usuario->getFilterId($id);
endif;
$legenda = (isset($_GET["acao"])) ? 'Dados do Usuário' : 'Cadastro de Usuário';
$disable = (isset($_GET["acao"]) && $_SESSION["PRIVILEGIO"] != 'A' ) ? 'disabled' : '';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Usuário</title>
        <link href="/ProjetoPedro/css/estilo.css" rel="stylesheet" type="text/css"/>
        <script src="/ProjetoPedro/js/validacao.js" type="text/javascript"></script>
        <script src="/ProjetoPedro/js/jquery-1.2.6.pack.js" type="text/javascript"></script>
        <script src="/ProjetoPedro/js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript" /></script>
    </head>
    <body>
        <div class="geral">
            <div id="topo">
                <?php include 'inc/inc_topo_interno.php';?>
            </div>
            
            <div id="corpoCadastroUsuario">                                
                <div id="boxCadastro">
                    <fieldset> 
                        <legend align="center"><?php echo $legenda ?></legend><br>
                        <form action="/ProjetoPedro/controller/ctUsuario.php" method="POST" id="frmCadastroUsuario"/>
                            <label>Empresa:</label>
    						<input <?php echo $disable ?> required class="inputCadastro" type="text" value="<?php echo (isset($dados)) ? AlteraAcento($dados->RAZAO) : '';?>"  onblur="ValidaCampo(this.id);" placeholder="Informe a Razão Social" name="txtRazao" id="txtRazao" size="35"><span class="msg-aviso">*</span><br/>
                            <label>Responsável:</label>
    						<input <?php echo $disable ?> required class="inputCadastro"type="text" value="<?php echo (isset($dados)) ? AlteraAcento($dados->RESPONSAVEL) : '';?>"  onblur="ValidaCampo(this.id);" placeholder="Informe o responsável" name="txtResponsavel" id="txtResponsavel" size="35"><span class="msg-aviso">*</span><br/>
                            <label>E-mail:</label>
    						<input <?php echo $disable ?> required class="inputCadastro"type="email" value="<?php echo (isset($dados)) ? $dados->EMAIL : '';?>" onblur="ValidaCampo(this.id);" placeholder="Informe o e-mail" name="txtEmail" id="txtEmail" size="25"><span id="msgEmail" class="msg-aviso">*</span><br/>
                            <label>Senha:</label>
    						<input <?php echo $disable ?> required class="inputCadastro"type="password" value="<?php echo (isset($dados)) ? base64_decode($dados->SENHA) : '';?>" onblur="ValidaCampo(this.id);" placeholder="Informe a senha" name="txtSenha" id="txtSenha" size="20"><span class="msg-aviso">** Mínimo de 6 caracteres</span><br/>
                            <label>Confirma Senha:</label>
    						<input <?php echo $disable ?> required class="inputCadastro"type="password" value="<?php echo (isset($dados)) ? base64_decode($dados->SENHA) : '';?>" onblur="ValidaCampo(this.id);" placeholder="Confirme a senha" name="txtConfirmaSenha" id="txtConfirmaSenha" size="20"><span id="msgSenha" class="msg-aviso">*</span><br/>
                            <label>Fone:</label>
    						<input <?php echo $disable ?> required class="inputCadastro" type="text" value="<?php echo (isset($dados)) ? $dados->FONE : '';?>" onblur="ValidaCampo(this.id);" placeholder="Informe o telefone" name="txtFone" id="txtFone" size="20"><span class="msg-aviso">*</span><br/>
                            <label>CNPJ:</label>
    						<input <?php echo $disable ?> required class="inputCadastro"type="text" value="<?php echo (isset($dados)) ? $dados->CNPJ : '';?>" onblur="ValidaCampo(this.id);" placeholder="Informe o CNPJ" name="txtCnpj" id="txtCnpj" size="20"><span class="msg-aviso" id="msgCnpj">*</span><br/>
                            <?php if ($_SESSION['PRIVILEGIO'] == "A"): ?>
                                <label>Status:</label>
                                <select <?php echo $disable ?> required name="cmbStatus" id="cmbStatus" class="cmbCadastro" onblur="ValidaCampo(this.id);">
                                    <option value=""></option>
                                    <option value="A" <?php echo (isset($dados) && ($dados->STATUS == 'A')) ? 'selected' : ''; ?> >Ativo</option>
                                    <option value="I" <?php echo (isset($dados) && ($dados->STATUS == 'I')) ? 'selected' : ''; ?>>Inativo</option>
                                </select><span class="msg-aviso">*</span><br/>
                                <label>Privilégio:</label>
                                <select <?php echo $disable ?> required name="cmbPrivilegio" id="cmbPrivilegio" class="cmbCadastro" onblur="ValidaCampo(this.id);">
                                    <option value=""></option>
                                    <option value="A" <?php echo (isset($dados) && ($dados->PRIVILEGIO == 'A')) ? 'selected' : ''; ?> >Administrativo</option>
                                    <option value="U" <?php echo (isset($dados) && ($dados->PRIVILEGIO == 'U')) ? 'selected' : ''; ?>>Usuário</option>
                                </select><span class="msg-aviso">*</span><br/>
                                <input type="hidden" name="acao" value="<?php echo (isset($dados)) ? 'editar' : 'incluir'; ?>"/>
                                <input type="hidden" name="id" value="<?php echo (isset($dados)) ? $dados->ID_USUARIO : ''; ?>"/>
                            <?php endif; ?>
                        </form>
                        <span class="msg-aviso">* Campos obrigatórios.</span><br/>
                        <span class="msg-aviso">** Senha com mínimo de 6 caracteres.</span>
                        <hr>
                        <div id="controlaBotao">
                            <?php if ($_SESSION['PRIVILEGIO'] == "A"): ?>
                                <input type="image" class="btnImagem"src="/ProjetoPedro/images/btnGravar.png" alt="Gravar" title="Gravar Usuário" onclick="ValidaDados();"> 
                                <input type="image" class="btnImagem"src="/ProjetoPedro/images/btnLimpar.png" alt="Limpar" title="Limpar Campos" onclick="Limpar();"> 
                            <?php endif; ?>
                            <input type="image" class="btnImagem"src="/ProjetoPedro/images/btnVoltar.png" alt="Voltar" title="Página principal" onclick="window.location='/ProjetoPedro/principal'">  
                        </div> 
                    </fieldset>
                </div>
            </div>
            
            <div class="rodape">
                <?php include 'inc/inc_rodape.php';?>
            </div> 
        </div>  
        
        <script type="text/javascript">
            // Adição de máscara para os campos telefone e cnpj
            $(document).ready(function(){ 
                $("#txtFone").mask("(99) 9999-9999");  
                $("#txtCnpj").mask("99.999.999/9999-99");
            });
        </script>
    </body>
</html>
