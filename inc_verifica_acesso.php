<?php
session_start();
if (empty($_SESSION['LIBERADO']) || $_SESSION['LIBERADO'] == FALSE):
    echo "<script>window.location='/ProjetoPedro/acesso-negado'</script>";
endif;

