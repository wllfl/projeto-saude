<?php
$patologias = array('colesterol', 'glicemia', 'triglicerideos', 'hipotiroidismo', 'hipertiroidismo');
	
foreach($patologias as $valor):
	echo "<a href='javascript:void(window.open('grafico/grafico.php?patologia?colesterol','Pagina','left=1,top=1,width=578,height=640,scroll=yes'));'>Pagina</a>";
endforeach;	
?>