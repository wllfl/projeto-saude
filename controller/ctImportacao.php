<?php
session_start();
require_once "../config.php";
require_once PATH . "/autoload.php";

$upload = new Upload($_FILES['file'], "../planilhas/");
if ($upload->executaUpload()):
    echo "<script>alert('Upload realizado com sucesso!')</script>";
else:
    echo "<script>alert('Erro no Upload!')</script>";
endif;
echo "<script>window.close()</script>";



