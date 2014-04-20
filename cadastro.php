<?php
session_start();
require_once 'autoload.php';

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id']:'';

if (!empty($id)):
    $conexao = Conexao::getInstance();
    $usuario = new Usuario($conexao);
    $dados   = $usuario->getFilterId($id);
endif;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Usuario</title>
        <link href="/ProjetoPedro/css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="topo">
            <?php include './inc_topo_interno.php';?>
        </div>
        
        <div id="corpo">
            <div id="boxCadastro">
                <fieldset> 
                    <legend align="center">Cadastro de Usuario</legend>
                    <form action="/ProjetoPedro/controller/ctUsuario.php" method="POST" id="frmCadastroUsuario"/>
                    <label>Empresa:</label><input class="inputCadastro" type="text" value="<?php echo (isset($dados)) ? $dados->RAZAO : '';?>"  onblur="VerificaSize(this.id);" placeholder="Informe a Razao Social" name="txtRazao" id="txtRazao" size="40"><span class="msg-aviso">*</span></br>
                        <label>Responsável:</label><input class="inputCadastro"type="text" value="<?php echo (isset($dados)) ? $dados->RESPONSAVEL : '';?>"  onblur="VerificaSize(this.id);" placeholder="Informe o responsavel" name="txtResponsavel" id="txtResponsavel" size="20"><span class="msg-aviso">*</span></br>
                        <label>Email:</label><input class="inputCadastro"type="email" value="<?php echo (isset($dados)) ? $dados->EMAIL : '';?>" onblur="VerificaSize(this.id);" placeholder="Informe o e-mail" name="txtEmail" id="txtEmail" size="20"><span class="msg-aviso">*</span></br>
                        <label>Senha:</label><input class="inputCadastro"type="password" value="<?php echo (isset($dados)) ? base64_decode($dados->SENHA) : '';?>" onblur="VerificaSize(this.id);" placeholder="Informe a senha" name="txtSenha" id="txtSenha" size="20"><span class="msg-aviso">** Mínimo de 6 caracteres</span></br>
                        <label>Confirma Senha:</label><input class="inputCadastro"type="password" value="<?php echo (isset($dados)) ? base64_decode($dados->SENHA) : '';?>" onblur="VerificaSize(this.id);" placeholder="Confirme a senha" name="txtConfirmaSenha" id="txtConfirmaSenha" size="20"><span class="msg-aviso">*</span></br>
                        <label>Fone:</label><input class="inputCadastro" type="text" value="<?php echo (isset($dados)) ? $dados->FONE : '';?>" onblur="VerificaSize(this.id);" placeholder="Informe o telefone" name="txtFone" id="txtFone" size="20"><span class="msg-aviso">*</span></br>
                        <label>CNPJ:</label><input class="inputCadastro"type="text" value="<?php echo (isset($dados)) ? $dados->CNPJ : '';?>" onblur="VerificaSize(this.id);" placeholder="Informe o CNPJ" name="txtCnpj" id="txtCnpj" size="20"><span class="msg-aviso">*</span></br>
                        <label>Status</label>
                        <select name="cmbStatus" id="cmbStatus" class="cmbCadastro" onblur="VerificaSize(this.id);">
                            <option value=""></option>
                            <option value="A" <?php echo (isset($dados) && ($dados->STATUS == 'A')) ? 'selected' : ''; ?> >Ativo</option>
                            <option value="I" <?php echo (isset($dados) && ($dados->STATUS == 'I')) ? 'selected' : ''; ?>>Inativo</option>
                        </select></br>
                        <input type="hidden" name="acao" value="<?php echo (isset($dados)) ? 'editar' : 'incluir'; ?>"/>
                        <input type="hidden" name="id" value="<?php echo (isset($dados)) ? $dados->ID_USUARIO : ''; ?>"/>
                    </form>
                    <span class="msg-aviso">* Campos obrigatorios.</span><br/>
                    <span class="msg-aviso">** Senha com minimo de 6 caracteres.</span>
                    <hr>
                    <div id="controlaBotao">
                        <input type="image" class="btnImagem"src="/ProjetoPedro/images/btnGravar.png" alt="Gravar" title="Gravar Usuario" onclick="ValidaDados();"> 
                        <input type="image" class="btnImagem"src="/ProjetoPedro/images/btnLimpar.png" alt="Limpar" title="Limpar Campos"> 
                        <input type="image" class="btnImagem"src="/ProjetoPedro/images/btnVoltar.png" alt="Voltar" title="Pagina principal" onclick="window.location='/ProjetoPedro/principal'">  
                    </div> 
                </fieldset>
            </div>
        </div>
        
        <script type="text/javascript">
            function ValidaDados(){
                var razao       = document.getElementById('txtRazao').value;
                var responsavel = document.getElementById('txtResponsavel').value;
                var email       = document.getElementById('txtEmail').value;
                var senha       = document.getElementById('txtSenha').value;
                var confirmacao = document.getElementById('txtConfirmaSenha').value;
                var fone        = document.getElementById('txtFone').value;
                var status      = document.getElementById('cmbStatus').value;
                var form        = document.getElementById('frmCadastroUsuario');
                
                if (razao == '' || responsavel == '' || email == '' || senha == '' || confirmacao == '' || fone == '' || status == ''){
                    alert('E necessário preencher os campos obrigatorios (*).');
                }else{
                    if (senha.length < 6){
                        alert('Senha possui menos que 6 caracters!');
                        exit();
                    }else{
                        if (senha != confirmacao){
                           alert('Senha nao e igual a confirmaçao!');
                           exit(); 
                        }
                    }
                    form.submit();
                }
            }
            
            function VerificaSize(id){
                var box   = document.getElementById(id);
                var valor = document.getElementById(id).value;
                
                if (valor == ''){
                    box.style.backgroundColor = "#FFCACA";
                    box.style.borderColor = "#900";
                }else{
                    if((id == "txtSenha" || id == "txtConfirmaSenha") && valor.length < 6 ){
                        box.style.backgroundColor = "#FFCACA";
                        box.style.borderColor = "#900";
                    }else{
                        box.style.backgroundColor = "#e4e4e4";
                        box.style.borderColor = "#333333";
                    }
                }
                
            }
        </script>
    </body>
</html>
