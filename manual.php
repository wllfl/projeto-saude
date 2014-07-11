<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manual do Usuário</title>
        <link href="/ProjetoPedro/css/manual.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
			<div id="topo">
                <?php include 'inc/inc_topo_externo.php';?>
            </div>
			<br>

			<div id="container">
				<h1 class="titulo"> Manual do Usuário</h1><br>
				<hr><br><br>
			
				<div id="menu">
					<ul class="menu">
						<li><a href="#login">Login</li></a>
						<li><a href="#esqueciSenha">Esqueci a senha</li></a>
						<li><a href="#paginaPrincipal">Página Principal</li></a>
						<li><a href="#gerenciarImportacao">Gerenciar Importações</li></a>
						<li><a href="#gerarGrafico">Gerar Gráfico</li></a>
						<li><a href="#downloadPlanilha">Download de Planilha</li></a>
						<li><a href="#importarPlanilha">Importar Planilha</li></a>
						<li><a href="#saudeOcupacional">Saúde Ocupacional</li></a>
					</ul><br>
				</div>
				<br>
				<input type="image" class="btnFechar"src="images/fechar.png" alt="Topo" onclick="window.close();" title="Voltar para o menu"><br>
				<input type="image" class="btnTopo" src="images/btnTopo.png" alt="Topo" onclick="window. 	location='#topo'" title="Voltar para o menu">
				<br><hr><br>
				<h1 id="login">LOGIN</h1>
					<p>
						Na tela de login terá dois campos, o e-mail e o campo Senha.
						No campo e-mail você deverá inserir o e-mail que foi realizado no cadastro da empresa, e no campo Senha deverá ser inserida a senha correspondente ao e-mail que foi cadastrado.
						Abaixo teremos um campo que deverá ser preenchido caso o usuário queira que sua senha seja lembrada na próxima vez que for utilizar o sistema, ao lado teremos um link caso tenha esquecido sua senha.
						Após inserir os campos e-mail e senha clique no botão Entrar para acessar o sistema. 
					</p>
					<br>
					<img class="imagem" src="images/login.png" alt="Login">
					<br>
					<br><hr><br>
				
				<h1 id="esqueciSenha">Esqueci minha senha</h1>
				<p>	
					Nessa página teremos apenas um campo onde deverá ser inserido o e-mail no qual o usuário recebera um link para realizar o cadastro de uma nova senha de acesso. 
					Abaixo teremos dois botões, um “Voltar” que redireciona o usuário a página de login e o “Enviar” para que envie as instruções para recupera-la na conta de e-mail do usuario.
				</p><br>
				<img class="imagem" src="images/esqueciSenha.png" alt="Esqueci a Senha">
				<br>
				<br><hr><br>
				
				<h1 id="paginaPrincipal">Página Principal</h1><br>
					<h3>Barra Superior</h3>
						<p>
							No topo da pagina há uma barra que sempre estará visível durante a sua navegação pelo sistema, contendo o nome do usuário que está conectado. Clicando duas vezes em cima do nome você poderá acessar rapidamente seu perfil, ao lado do usuário temos a data atual e a opção de sair do sistema.
						</p><br>
						<img class="imagem" src="images/barraSuperior.png" alt="Barra Superior">
						<br>
						<br>
					<h3>Painel de Informações</h3>
						<p>
							Ao lado esquerdo se encontra um Painel de Informações, disponibilizando as últimas importações contendo o “id do processo”, “Data/Hora” e a “Quantidade de Registros” de suas importações.
						</p><br>
						<img class="imagem" src="images/painelInfo.png" alt="Painel de Informações">
						<br>
						<br>
					<h3>Painel Principal</h3>
						<p>
							Ao lado direito se encontra o painel principal contendo seis botões sendo eles :“Gerenciar Importações”, “Download Planilha”, ”Manual do usuário”, “Gerar Gráfico”, “Importar Planilha” e “Saúde Ocupacional”.
						</p>
						<br>
						<img class="imagem" src="images/painelPrincipal.png" alt="Painel Principal">
						<br>
						<hr><br>
				
				<h1 id="gerenciarImportacao">Gerenciar Importações</h1>
					<p>
						Essa página nos mostra todas as importações que temos do usuário que está conectado no momento, informando o número de registro daquela importação, o nome do usuário que fez a importação, a quantidade de registros, data e hora que a planilha foi importada no sistema.
						Ao clicar no botão voltar que se localiza abaixo da planilha,o usuário sera redirecionado para a página inicial. A importação pode ser excluída ao clicar no botão X que fica no final de cada importação.
						Obs.:O sistema só armazena as ultimas doze importações, ou seja ele sempre ira apagar a mais velha.
					</p>
					<br>
					<img class="imagem" src="images/gerenciarInfo.png" alt="Gerenciar Importações"><br>
					<br><hr><br>
				
				<h1 id="gerarGrafico">Gerar Gráfico</h1>	
					<p>
						No topo superior da página de gerar gráficos há duas caixas de seleção. A primeira podemos selecionar a patologia (sintomas das doenças) para a qual desejamos filtrar nossa importação, na segunda caixa podemos selecionar a importação com o data e hora para gerar os gráficos, toda vez que houver alguma alteração em alguma dessas caixas de seleção os gráficos serão atualizados e apresentados abaixo.
						Para sair da página basta clicar no botão fechar no topo ou no fechar na aba do navegador.
					</p><br>
					<img class="imagem" src="images/gerarGrafico.png" alt="Gerar Gráficos">
					<br><br>
				
				<h3>Gráficos Dinâmicos</h3>
					<p>
						Os gráficos apresentados de uma forma dinâmica, podendo mudar conforme suas escolhas.
						Ao clicar na legenda colorida abaixo do gráfico é possível remover ou adicionar parcialmente partes do gráfico. Colocando o cursor do mouse sobre os blocos,O usuário terá informações detalhadas de cada tema e clicando sobre o bloco que deseja, ele se destacaraá dos demais.
						No canto direito superior de cada gráfico há um botão que ao ser clicado pelo usuário será disponibilizado as opções de download do gráfico.
					</p>
					<br><br>
					<img class="imagem" src="images/graficosGerados.png" alt="Gráficos Gerados">
					<br>
					<hr><br>
				
				<h1 id="downloadPlanilha">Download de Planilha</h1>
					<p>
						Ao clicar em Download será baixada uma planilha formatada deve ser preenchida corretamente para posteriormente ser importada.
					</p>
					<br>
					<img class="imagem" src="images/downloadPlanilha.png" alt="Download Planilha">
					<br><br>	
					<hr><br>
				
				<h1 id="importarPlanilha">Importar Planilha</h1>
					<p>
						Para importar uma planilha o usuário deve clicar em "Escolher arquivo" onde o usuário navegará até o local de armazenamento da planilha. Após a planilha ser selecionada, basta clicar em "Importar". Caso o usuário queira voltar para a página inicial, basta clicar em "Voltar".
					</p><br>
					<img class="imagem" src="images/importarPlanilha.png" alt="Importar Planilha">
					<br>
					<hr><br>
				
				<h1 id="saudeOcupacional">Saúde Ocupacional</h1>
					<p>
						Contém informações sobre saúde ocupacional.
					</p>
					<br>
					<img class="imagem" src="images/saudeOcp.png" alt="Sobre Saúde Ocupacional">
					<br><br>
					<hr><br>
			</div>
    </body>
    </html>