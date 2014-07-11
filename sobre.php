<?php
session_start();
require_once 'inc/inc_verifica_acesso.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sobre Saúde Ocupacional</title>
        <link href="css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="geral">
            <div id="topo">
                <?php include 'inc/inc_topo_interno.php';?>
            </div>
            
            <div id="corpoSobre">
                <div id="painelInfo">
                    <?php include 'inc/inc_painelInfo.php';?>                    
                </div>
               
                <div id="painelSecundario">
                    <div id="informacao">
                        <h3>Sobre Saúde Ocupacional</h3><br/>
                        <p>
                        Saúde Ocupacional consiste na promoção de condições laborais que garantam o mais elevado grau de qualidade de vida no trabalho, protegendo a saúde dos trabalhadores, promovendo o bem-estar físico, mental e social, prevenindo e controlando os acidentes e as doenças através da redução das condições de risco.
        A saúde ocupacional não se limita apenas a cuidar das condições físicas do trabalhador, já que também trata da questão psicológica. Para os empregadores, a saúde ocupacional supõe um apoio ao aperfeiçoamento do funcionário e à conservação da sua capacidade de trabalho.
        Os problemas mais frequentes dos profissionais que lidam com a saúde ocupacional são as fraturas, os cortes e as distensões por acidentes no trabalho, os distúrbios por movimentos repetitivos, os problemas de visão e de audição e as doenças causadas pela exposição a substâncias anti-higiénicas ou radioativas, por exemplo. Também se podem deparar com o stress causado pelo trabalho ou pelas relações laborais.
        Convém destacar que a saúde ocupacional é um tema importante para os governos, os quais devem garantir o bem-estar dos trabalhadores e o cumprimento das normas no âmbito do trabalho. Para tal, é hábito realizarem inspeções periódicas de modo a determinar as condições mediante as quais são desenvolvidos os vários tipos de atividades laborais

                        </p>
                        <br/>
                        <input type="image" src="/ProjetoPedro/images/btnVoltar.png" class="btnImagem" alt="Voltar" onclick="window.location='/ProjetoPedro/principal'" title="Página principal"/>
                    </div>
                </div>
            </div>
            <div class="rodape">
            <?php include 'inc/inc_rodape.php';?>
        </div> 
        </div>     
    </body>
</html>
