<?php
session_start();
session_destroy();
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="/ProjetoPedro/css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
       <div id="topo">
            <?php include "./inc_topo_externo.php"; ?>
        </div>
        
        <div id="corpo">
            
            <fieldset id="boxLogin">
                 <h1>Login</h1>
                 <div id="msgLogin">
                    <?php echo $msg = (isset($_SESSION['MSG_LOGIN'])) ? $_SESSION['MSG_LOGIN'] : '' ; ?>
                 </div>
                 <form id="frmLogin" action="/ProjetoPedro/controller/ctUsuario.php?acao=validar" method="POST" onsubmit="return Validar();">
                     <label>E-mail:</label><input type="text" name="txtEmail" id="txtEmail" class="inputlogin" placeholder="Informe o E-mail"></br></br>        
                     <label>Senha:</label><input type="password" name="txtSenha" id="txtSenha" class="inputlogin" placeholder="Informe a Senha"></br></br>
                    <input type="checkbox" id="ckremenber" class="ckremenber">Lembrar senha<a class="esquecisenha" href="enviar-senha">Esqueci minha senha</a></br></br><br/>         
                    <input type="submit" name="btnlogin" class="botao" id="btnlogin" value="Entrar"/>
                </form>
            </fieldset>
        </div>
        <script type="text/javascript">
            function Validar(){
                var email = document.getElementById('txtEmail').value;
                var senha = document.getElementById('txtSenha').value;
                
                if (email == '' || senha == ''){
                    alert('E necessário informar Usuário e Senha!');
                    return false;
                }else{
                    return true;
                }
                
            }
        </script>
    </body>
</html>
