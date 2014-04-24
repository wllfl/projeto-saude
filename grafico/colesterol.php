<?php
require_once "../autoload.php";
$pdo  = Conexao::getInstance();

$sql1 = "SELECT SUM(QTDE_D) AS DESCONHECEM, SUM(QTDE_N) AS NORMAL, SUM(QTDE_S) AS ELEVADO, (SUM(QTDE_D) + SUM(QTDE_N) + SUM(QTDE_S)) AS TOTAL ";
$sql1 .= "FROM TAB_PLANILHA ";
$sql1 .= "WHERE PATOLOGIA = 'COLESTEROL' ";
$stm = $pdo->prepare($sql1);
$stm->execute();
$geral = $stm->fetch(PDO::FETCH_OBJ);

$sql2 = "SELECT DISTINCT (SELECT SUM(QTDE_S) AS ELEVADO FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'F') AS FEMININO, ";
$sql2 .= "(SELECT SUM(QTDE_S) AS ELEVADO FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M') AS MASCULINO ";
$sql2 .= "FROM TAB_PLANILHA ";
$stm = $pdo->prepare($sql2);
$stm->execute();
$geralSexo = $stm->fetch(PDO::FETCH_OBJ);

$sql3 = "SELECT DISTINCT ";
$sql3 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '18-20') AS faixa1, ";
$sql3 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '21-30') AS faixa2, ";
$sql3 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '31-40') AS faixa3, ";
$sql3 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '41-50') AS faixa4, ";
$sql3 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '51-60') AS faixa5, ";
$sql3 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '61-70') AS faixa6, ";
$sql3 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '71-80') AS faixa7 ";
$sql3 .= "FROM TAB_PLANILHA ";
$stm = $pdo->prepare($sql3);
$stm->execute();
$faixaHomem = $stm->fetch(PDO::FETCH_OBJ);

$sql4 = "SELECT DISTINCT ";
$sql4 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'F' AND FAIXA_ETARIA = '18-20') AS faixa1, ";
$sql4 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'F' AND FAIXA_ETARIA = '21-30') AS faixa2, ";
$sql4 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'F' AND FAIXA_ETARIA = '31-40') AS faixa3, ";
$sql4 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'F' AND FAIXA_ETARIA = '41-50') AS faixa4, ";
$sql4 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'F' AND FAIXA_ETARIA = '51-60') AS faixa5, ";
$sql4 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'F' AND FAIXA_ETARIA = '61-70') AS faixa6, ";
$sql4 .= "(SELECT QTDE_S FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'F' AND FAIXA_ETARIA = '71-80') AS faixa7 ";
$sql4 .= "FROM TAB_PLANILHA ";
$stm = $pdo->prepare($sql4);
$stm->execute();
$faixaMulher = $stm->fetch(PDO::FETCH_OBJ);

$sql5 = "SELECT DISTINCT (SELECT SUM(QTDE_T) FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL') AS SIM, ";
$sql5 .= "(SELECT (SUM(QTDE_S) - SUM(QTDE_T)) FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL') AS NAO ";
$sql5 .= "FROM TAB_PLANILHA ";
$stm = $pdo->prepare($sql5);
$stm->execute();
$geralTratamento = $stm->fetch(PDO::FETCH_OBJ);

$sql6 = "SELECT DISTINCT (SELECT SUM(QTDE_T) FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'F') AS FEMININO, ";
$sql6 .= "(SELECT (SUM(QTDE_S) - SUM(QTDE_T)) FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M') AS MASCULINO ";
$sql6 .= "FROM TAB_PLANILHA ";
$stm = $pdo->prepare($sql6);
$stm->execute();
$tratamentoSexo = $stm->fetch(PDO::FETCH_OBJ);

$sql7 = "SELECT DISTINCT (SELECT SUM(QTDE_H) FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL') AS SIM, ";
$sql7 .= "(SELECT (SUM(QTDE_D)+SUM(QTDE_N)+SUM(QTDE_S)) - SUM(QTDE_H) FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL') AS NAO ";
$sql7 .= "FROM TAB_PLANILHA ";
$stm = $pdo->prepare($sql7);
$stm->execute();
$geralHistorico = $stm->fetch(PDO::FETCH_OBJ);

$sql3 = "SELECT DISTINCT ";
$sql3 .= "(SELECT QTDE_D FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '18-20') AS faixa1, ";
$sql3 .= "(SELECT QTDE_D FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '21-30') AS faixa2, ";
$sql3 .= "(SELECT QTDE_D FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '31-40') AS faixa3, ";
$sql3 .= "(SELECT QTDE_D FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '41-50') AS faixa4, ";
$sql3 .= "(SELECT QTDE_D FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '51-60') AS faixa5, ";
$sql3 .= "(SELECT QTDE_D FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '61-70') AS faixa6, ";
$sql3 .= "(SELECT QTDE_D FROM TAB_PLANILHA WHERE PATOLOGIA = 'COLESTEROL' AND SEXO = 'M' AND FAIXA_ETARIA = '71-80') AS faixa7 ";
$sql3 .= "FROM TAB_PLANILHA ";
$stm = $pdo->prepare($sql3);
$stm->execute();
$faixaDesconhecem = $stm->fetch(PDO::FETCH_OBJ);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Exemplo de Graficos</title>
		<link href="/ProjetoPedro/css/estilo.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="/ProjetoPedro/js/jquery.js"></script>
		<script src="/ProjetoPedro/js/highcharts.js"></script>
		<script src="/ProjetoPedroe/js/modules/exporting.js"></script>
		<script type="text/javascript">
		$(function () {
			$('#container1').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Colesterol Elevado - (Total de participantes: <?php echo $geral->TOTAL; ?>)',
					style:{
							color: '#3E576F',
							fontSize: '14px'
					}
				},
				subtitle:{
					text: 'Fonte: Ferramenta para Avaliação de Saúde Ocupacional',
					style:{
							color: '#3E576F',
							fontSize: '10px'
					}
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						},
						showInLegend: true
					}
				},
				series: [{
					type: 'pie',
					name: 'Indice Colesterol',
					data: [
						['Desconhece',  <?php echo $geral->DESCONHECEM; ?>],
						{
							name: 'Elevado',
							y: <?php echo $geral->ELEVADO; ?>,
							sliced: true,
							selected: true,
							color: '#BF0B23'
						},
						{	name: 'Normal',   
							y: <?php echo $geral->NORMAL; ?>,
							color: '#92C146'
						}
					]
				}]
			});
			
			$('#container2').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Colesterol Elevado - (Homens / Mulheres)',
					style:{
							color: '#3E576F',
							fontSize: '14px'
					}
				},
				subtitle:{
					text: 'Fonte: Ferramenta para Avaliação de Saúde Ocupacional',
					style:{
							color: '#3E576F',
							fontSize: '10px'
					}
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						},
						showInLegend: true
					}
				},
				series: [{
					type: 'pie',
					name: 'Indice Colesterol',
					data: [
						{
							name: 'Homens',
							y: 12.8,
							sliced: true,
							selected: true
						},
						{
							name: 'Mulheres',
							y: <?php echo $geralSexo->FEMININO; ?>,
							color: '#993399'
						
						}

					]
				}]
			});
			
			$('#container3').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Colesterol Elevado - (Homens)',
					style:{
							color: '#3E576F',
							fontSize: '14px'
					}
				},
				subtitle:{
					text: 'Fonte: Ferramenta para Avaliação de Saúde Ocupacional',
					style:{
							color: '#3E576F',
							fontSize: '10px'
					}
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						},
						showInLegend: true
					}
				},
				series: [{
					type: 'pie',
					name: 'Indice Colesterol',
					data: [
						{
							name: '18-20 anos',
							y: <?php echo $faixaHomem->faixa1; ?>,
							sliced: true,
							selected: true
						},
						['21-30 anos', <?php echo $faixaHomem->faixa2; ?>],
						['31-40 anos', <?php echo $faixaHomem->faixa3; ?>],
						['41-50 anos', <?php echo $faixaHomem->faixa4; ?>],
						['51-60 anos', <?php echo $faixaHomem->faixa5; ?>],
						['61-70 anos', <?php echo $faixaHomem->faixa6; ?>],
						['81-90 anos', <?php echo $faixaHomem->faixa7; ?>],
					]
				}]
			});
			
			$('#container4').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Colesterol Elevado - (Mulheres)',
					style:{
							color: '#3E576F',
							fontSize: '14px'
					}
				},
				subtitle:{
					text: 'Fonte: Ferramenta para Avaliação de Saúde Ocupacional',
					style:{
							color: '#3E576F',
							fontSize: '10px'
					}
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						},
						showInLegend: true
					}
				},
				series: [{
					type: 'pie',
					name: 'Indice Colesterol',
					data: [
						{
							name: '18-20 anos',
							y: <?php echo $faixaMulher->faixa2; ?>,
							sliced: true,
							selected: true
						},
						['21-30 anos', <?php echo $faixaMulher->faixa2; ?>],
						['31-40 anos', <?php echo $faixaMulher->faixa3; ?>],
						['41-50 anos', <?php echo $faixaMulher->faixa4; ?>],
						['51-60 anos', <?php echo $faixaMulher->faixa5; ?>],
						['61-70 anos', <?php echo $faixaMulher->faixa6; ?>],
						['81-90 anos', <?php echo $faixaMulher->faixa7; ?>],
					]
				}]
			});
			
			$('#container5').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Colesterol Elevado - (Fazem Tratamento)',
					style:{
							color: '#3E576F',
							fontSize: '14px'
					}
				},
				subtitle:{
					text: 'Fonte: Ferramenta para Avaliação de Saúde Ocupacional',
					style:{
							color: '#3E576F',
							fontSize: '10px'
					}
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						},
						showInLegend: true
					}
				},
				series: [{
					type: 'pie',
					name: 'Fazem tratamento',
					data: [
						{
							name: 'Sim',
							y: <?php echo $geralTratamento->SIM; ?>,
							sliced: true,
							selected: true
						},
						['Não', <?php echo $geralTratamento->NAO; ?>],

					]
				}]
			});
			
			$('#container6').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Colesterol Elevado - (Tratamento Homens / Mulheres)',
					style:{
							color: '#3E576F',
							fontSize: '14px'
					}
				},
				subtitle:{
					text: 'Fonte: Ferramenta para Avaliação de Saúde Ocupacional',
					style:{
							color: '#3E576F',
							fontSize: '10px'
					}
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						},
						showInLegend: true
					}
				},
				series: [{
					type: 'pie',
					name: 'Fazem tratamento',
					data: [
						{
							name: 'Homens',
							y: <?php echo $tratamentoSexo->MASCULINO; ?>,
							sliced: true,
							selected: true
						},
						{
							name: 'Mulheres',
							y: <?php echo $tratamentoSexo->FEMININO; ?>,
							color: '#993399'
						
						}

					]
				}]
			});
			
			$('#container7').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Faixa etária participantes que desconhecem',
					style:{
							color: '#3E576F',
							fontSize: '14px'
					}
				},
				subtitle:{
					text: 'Fonte: Ferramenta para Avaliação de Saúde Ocupacional',
					style:{
							color: '#3E576F',
							fontSize: '10px'
					}
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						},
						showInLegend: true
					}
				},
				series: [{
					type: 'pie',
					name: 'Fazem tratamento',
					data: [
						{
							name: '18-20 anos',
							y: <?php echo $faixaDesconhecem->faixa1; ?>,
							sliced: true,
							selected: true
						},
						['21-30 anos', <?php echo $faixaDesconhecem->faixa2; ?>],
						['31-40 anos', <?php echo $faixaDesconhecem->faixa3; ?>],
						['41-50 anos', <?php echo $faixaDesconhecem->faixa4; ?>],
						['51-60 anos', <?php echo $faixaDesconhecem->faixa5; ?>],
						['61-70 anos', <?php echo $faixaDesconhecem->faixa6; ?>],
						['81-90 anos', <?php echo $faixaDesconhecem->faixa7; ?>],
					]
				}]
			});
			
			$('#container8').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Participantes com Histórico Familiar (Colesterol)',
					style:{
							color: '#3E576F',
							fontSize: '14px'
					}
				},
				subtitle:{
					text: 'Fonte: Ferramenta para Avaliação de Saúde Ocupacional',
					style:{
							color: '#3E576F',
							fontSize: '10px'
					}
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						},
						showInLegend: true
					}
				},
				series: [{
					type: 'pie',
					name: 'Fazem tratamento',
					data: [
						{
							name: 'Sim',
							y: <?php echo $geralHistorico->SIM; ?>,
							sliced: true,
							selected: true
						},
						['Não', <?php echo $geralHistorico->NAO; ?>],
					]
				}]
			});
			
		});
   
		</script>
	</head>
	<body>
	    <div style="width: 1000px; min-height:600px;margin: 0 auto;">
			<h1 style="text-align: center">Colesterol</h1>
			<div id="container1" class="box-grafico">
			</div>
			<div id="container2" class="box-grafico">
			</div>
			<div id="container3" class="box-grafico">
			</div>
			<div id="container4" class="box-grafico">
			</div>
			<div id="container5" class="box-grafico">
			</div>
			<div id="container6" class="box-grafico">
			</div>
			<div id="container7" class="box-grafico">
			</div>
			<div id="container8" class="box-grafico">
			</div>
		</div>
	</body>
</html>