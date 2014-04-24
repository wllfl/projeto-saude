<?php
header('Content-type: text/html; charset=utf-8');
session_start();
require_once "../config.php";
require_once PATH . "/autoload.php";

$conexao     = Conexao::getInstance();
$objUsuario  = new Usuario($conexao);
$msg         = '';
$acao        = (isset($_REQUEST['acao'])) ? $_REQUEST['acao'] : '';
$id          = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : '';
$razao       = (isset($_POST['txtRazao'])) ? $_POST['txtRazao'] : '';
$cnpj        = (isset($_POST['txtCnpj'])) ? $_POST['txtCnpj'] : '';
$fone        = (isset($_POST['txtFone'])) ? $_POST['txtFone'] : '';
$responsavel = (isset($_POST['txtResponsavel'])) ? $_POST['txtResponsavel'] : '';
$email       = (isset($_REQUEST['txtEmail'])) ? $_REQUEST['txtEmail'] : '';
$senha       = (isset($_REQUEST['txtSenha'])) ? $_REQUEST['txtSenha'] : '';
$confSenha   = (isset($_POST['txtConfirmaSenha'])) ? $_POST['txtConfirmaSenha'] : '';
$status      = (isset($_POST['cmbStatus'])) ? $_POST['cmbStatus'] : '';
$remenber    = (isset($_POST['ckremenber'])) ? $_POST['ckremenber'] : '';

if ($acao == 'validar'):

    if (!empty($email) && !empty($senha)):
        Usuario::validaUsuario($email, $senha, $conexao);
    
        if(isset($_SESSION['LIBERADO'])):
            if ($_SESSION['LIBERADO'] == TRUE): 
                $expirytime = time() + 365*24*60*60; 
                if ($remenber == "s"):
                   setCookie('CookieAutoLogin', 'autologin', $expirytime);
                   setCookie('CookieEmail', $email, $expirytime);
                   setCookie('CookieSenha', base64_encode($senha), $expirytime);
                endif;
                echo "<script>window.location = '/ProjetoPedro/principal'</script>";
            else:
                $_SESSION['MSG_LOGIN'] = "<span class='ms no'>Usuário ou Senha incorretos!</span>";
            endif;
        endif;
    else:
        $_SESSION['MSG_LOGIN'] = "<span class='ms al'>É necessário informar Usuário e Senha!</span>";
    endif;
    
    if (isset($_SESSION['MSG_LOGIN']) && !empty($_SESSION['MSG_LOGIN'])):
        echo "<script>window.location = '/ProjetoPedro/login'</script>";
    endif;
endif;

if ($acao == 'incluir'):
    if (!empty($razao) && !empty($cnpj) && !empty($responsavel) && !empty($fone) && !empty($email) && !empty($senha) && !empty($status)):
        $array = array($razao, $cnpj, $fone, $responsavel, $email, base64_encode($senha), $status);
        $retorno = $objUsuario->insert($array);
        
        if ($retorno):
            echo "<script>alert('Usuário inserido com sucesso!')</script>";
        else:    
            echo "<script>alert('Erro ao insetir usuário!')</script>";
        endif;
    else:
        echo "<script>É necessário preencher os campos obrigatórios(*).</script>";
    endif;
    
    echo "<script>window.location='/ProjetoPedro/principal'</script>";
endif;

if ($acao == 'editar'):
    if (!empty($razao) && !empty($cnpj) && !empty($responsavel) && !empty($fone) && !empty($email) && !empty($senha) && !empty($status)):
        $array = array($razao, $cnpj, $fone, $responsavel, $email, base64_encode($senha), $status, $id);
        $retorno = $objUsuario->update($array);
        
        if ($retorno):
            echo "<script>alert('Usuário editado com sucesso!')</script>";
        else:    
            echo "<script>alert('Erro ao editar usuário!')</script>";
        endif;
    else:
        echo "<script>É necessário preencher os campos obrigatários(*).</script>";
    endif;
    
    echo "<script>window.location='/ProjetoPedro/pesquisar-usuario'</script>";
endif;

if ($acao == 'excluir'):
    if (!empty($id)):
       $retorno = $objUsuario->delete($id);
    
       if ($retorno):
            echo "<script>alert('Usuário excluído com sucesso!')</script>";
       else:    
            echo "<script>alert('Erro ao excluir usuário!')</script>";
       endif;
       
       echo "<script>window.location='/ProjetoPedro/pesquisar-usuario'</script>";
    endif;
endif;