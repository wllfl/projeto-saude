<?php
session_start();
require_once 'config.php';
require_once PATH . "/autoload.php";

$email   = (isset($_COOKIE['CookieEmail'])) ? $_COOKIE['CookieEmail'] : '' ;
$senha   = (isset($_COOKIE['CookieSenha'])) ? base64_decode($_COOKIE['CookieSenha']) :'';
$checked = (isset($_COOKIE['CookieAutoLogin']) && $_COOKIE['CookieAutoLogin'] == 'autologin') ? 'checked' : '';
$acao    = (isset($_REQUEST['acao'])) ? $_REQUEST['acao'] : '';
unset($_SESSION['MSG_LOGIN']);

if ($acao == 'validar'):
    $email    = (isset($_REQUEST['txtEmail'])) ? $_REQUEST['txtEmail'] : '';
    $senha    = (isset($_REQUEST['txtSenha'])) ? $_REQUEST['txtSenha'] : '';
    $remenber = (isset($_POST['ckremenber']))  ? $_POST['ckremenber'] : '';
    
    if (!empty($email) && !empty($senha)):
        Usuario::validaUsuario($email, $senha, Conexao::getInstance());
    
        if(isset($_SESSION['LIBERADO'])):
            if ($_SESSION['LIBERADO'] == TRUE): 
			    if ($_SESSION['ATIVO'] == TRUE): 
					if ($remenber == "s"):
					   $expirytime = time() + 365*24*60*60; 
					   setCookie('CookieAutoLogin', 'autologin', $expirytime);
					   setCookie('CookieEmail', $email, $expirytime);
					   setCookie('CookieSenha', base64_encode($senha), $expirytime);
					else:
					   setCookie('CookieAutoLogin');
					   setCookie('CookieEmail');
					   setCookie('CookieSenha');
					endif;
					echo "<script>window.location = '/ProjetoPedro/principal'</script>";
				else:
					$_SESSION['MSG_LOGIN'] = "<span class='ms al'>Usuário não está ativo!</span>";
				endif;
            else:
                $_SESSION['MSG_LOGIN'] = "<span class='ms no'>Usuário ou Senha incorretos!</span>";
            endif;
        endif;
    else:
        $_SESSION['MSG_LOGIN'] = "<span class='ms al'>É necessário informar Usuário e Senha!</span>";
    endif;
else:
   session_destroy();
endif;

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
            <?php include "inc/inc_topo_interno.php"; ?>
        </div>
        
        <div id="corpo">
            <fieldset id="boxLogin">
                 <h1>Login</h1>
                 <div id="msgLogin">
                    <?php echo $msg = (isset($_SESSION['MSG_LOGIN'])) ? $_SESSION['MSG_LOGIN'] : '' ; ?>
                 </div>
                 <form id="frmLogin" action="/ProjetoPedro/index.php" method="POST" onsubmit="return Validar();">
                     <label>E-mail:</label>
                     <input type="text" name="txtEmail" id="txtEmail" class="inputlogin" placeholder="Informe o E-mail" value="<?php echo (isset($email)) ? $email : ''; ?>"></br></br>        
                     <label>Senha:</label>
                     <input type="password" name="txtSenha" id="txtSenha" class="inputlogin" placeholder="Informe a Senha" value="<?php echo (isset($senha)) ? $senha : ''; ?>"></br></br>
                     <input type="checkbox" id="ckremenber" name="ckremenber" class="ckremenber" value="s" <?php echo (!empty($checked)) ? $checked : ''; ?>>
                     Lembrar senha<a class="esquecisenha" href="enviar-senha">Esqueci minha senha</a></br></br><br/>  
					 <input type="hidden" name="acao" value="validar"/>					 
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
