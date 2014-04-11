<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
	    <div id="topo">
			<div id="titulo">
			    <br>
				<span class="TituloTopo">Ferramenta para Avaliação de Saúde Ocupacional</span>
			</div>
		</div>
		<div id="corpo">
                        <fieldset id="boxLogin">
				<h1>Login</h1><br/>
				<form action="home.php" method="">
					<label>Usuário:</label><input type="text" name="user" id="user" class="inputlogin" value="Informe o usuário" onblur="if (this.value == '') {this.value = 'Informe o usuário';}" onclick="if (this.value == 'Informe o usuário') {this.value = '';}"></br></br>        
					<label>Senha:</label><input type="password" name="pass" id="pass" class="inputlogin" value="Informe a senha" onblur="if (this.value == '') {this.value = 'Informe a senha';}" onclick="if (this.value == 'Informe a senha') {this.value = '';}"></br></br>
					<input type="checkbox" id="ckremenber" class="ckremenber">Lembrar senha<a class="esquecisenha" href="#">Esqueci minha senha</a></br></br><br/>         
					<input type="button" name="btnlogin" class="botao" id="btnlogin" value="Entrar">
				</form>
			</fieldset>
		</div>
    </body>
</html>
