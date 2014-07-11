// Função para validar os campos antes de submeter o form
function ValidaDados(){
    var razao       = document.getElementById('txtRazao').value;
    var responsavel = document.getElementById('txtResponsavel').value;
    var email       = document.getElementById('txtEmail').value;
    var senha       = document.getElementById('txtSenha').value;
    var confirmacao = document.getElementById('txtConfirmaSenha').value;
    var fone        = document.getElementById('txtFone').value;
    var status      = document.getElementById('cmbStatus').value;
    var cnpj        = document.getElementById('txtCnpj').value;
    var form        = document.getElementById('frmCadastroUsuario');
    var input       = document.getElementsByTagName('input');
    var select      = document.getElementsByTagName('select');
    
    // Verifica se existem campo
    if (razao == '' || responsavel == '' || email == '' || senha == '' || confirmacao == '' || fone == '' || status == '' || cnpj == ''){
                        
        for(var i=0; i<input.length; i++){
           if (input[i].value == ''){
               input[i].style.backgroundColor = "#FFCACA";
               input[i].style.borderColor = "#900";
           }else{
               if ((input[i].id == 'txtSenha' || input[i].id == 'txtConfirmaSenha') && input[i].value.length < 6){
                   input[i].style.backgroundColor = "#FFCACA";
                   input[i].style.borderColor = "#900";
               }else{
                   input[i].style.backgroundColor = "#e4e4e4";
                   input[i].style.borderColor = "#333333";
               }
           }
        }
        
        for(var i=0; i<select.length; i++){
           if (select[i].value == ''){
               select[i].style.backgroundColor = "#FFCACA";
               select[i].style.borderColor = "#900";
           }else{
               select[i].style.backgroundColor = "#e4e4e4";
               select[i].style.borderColor = "#333333";
           }
        }
        
        alert('É necessário preencher os campos obrigatórios (*).');
    }else{

        // Verifica se a senha contém menos que 6 caracteres
        if (senha.length < 6){
            alert('Senha possui menos que 6 caracters!');
            exit();
        }else{

            // Verifica se a senha é diferente da confirmação
            if (senha != confirmacao){
                var boxSenha     = document.getElementById('txtConfirmaSenha');
                var boxMsgSenha  = document.getElementById('msgSenha');

                boxSenha.style.backgroundColor = "#FFCACA";
                boxSenha.style.borderColor = "#900";
                boxMsgSenha.innerHTML = "Senha não confere";
                exit(); 
            }
        }

        // Verifica se o CNPJ é válido
        if(!validarCNPJ(cnpj)){
            var boxCnpj = document.getElementById('txtCnpj');
            var boxMsg  = document.getElementById('msgCnpj');

            boxCnpj.style.backgroundColor = "#FFCACA";
            boxCnpj.style.borderColor = "#900";
            boxMsg.innerHTML = "CNPJ  inválido";
            exit();
        }

        // Verifica se o E-mail é válido
        if(!validarEmail(email)){
            var boxEmail     = document.getElementById('txtEmail');
            var boxMsgEmail  = document.getElementById('msgEmail');

            boxEmail.style.backgroundColor = "#FFCACA";
            boxEmail.style.borderColor = "#900";
            boxMsgEmail.innerHTML = "E-mail  inválido";
            exit();
        }

        form.submit();
    }
}

// Função para validar os campos quando os mesmos perderem o focu
function ValidaCampo(id){
    var box         = document.getElementById(id);
    var valor       = document.getElementById(id).value;
    var boxMsgCnpj  = document.getElementById('msgCnpj');
    var boxMsgSenha = document.getElementById('msgSenha');
    var boxMsgEmail = document.getElementById('msgEmail');
    
    if (valor == ''){
        box.style.backgroundColor = "#FFCACA";
        box.style.borderColor = "#900";
    }else{
        box.style.backgroundColor = "#e4e4e4";
        box.style.borderColor = "#333333";
    }

    if (id == "txtEmail" && ! validarEmail(valor)){
        box.style.backgroundColor = "#FFCACA";
        box.style.borderColor = "#900";
        boxMsgEmail.innerHTML = "E-mail inválido";
    }else{
        if (id == "txtEmail" && validarEmail(valor)){
            box.style.backgroundColor = "#e4e4e4";
            box.style.borderColor = "#333333";
            boxMsgEmail.innerHTML = "*";
        }
    }

    if((id == "txtSenha" || id == "txtConfirmaSenha") && valor.length < 6 ){
        box.style.backgroundColor = "#FFCACA";
        box.style.borderColor = "#900";
        boxMsgSenha.innerHTML = "Senha não confere";
    }else{
        if((id == "txtSenha" || id == "txtConfirmaSenha") && valor.length >= 6 ){
            box.style.backgroundColor = "#e4e4e4";
            box.style.borderColor = "#333333";
            boxMsgSenha.innerHTML = "*";
        }
    }

    if (id == "txtCnpj" && ! validarCNPJ(valor)){
        box.style.backgroundColor = "#FFCACA";
        box.style.borderColor = "#900";
        boxMsgCnpj.innerHTML = "CNPJ  inválido";
    }else{
        if (id == "txtCnpj" && validarCNPJ(valor)){
            box.style.backgroundColor = "#e4e4e4";
            box.style.borderColor = "#333333";
            boxMsgCnpj.innerHTML = "*";
        }
    }
}

// Função para limpar os campos
function Limpar(){
    var input  = document.getElementsByTagName('input');
    var select = document.getElementsByTagName('select');
    
    for(var i=0; i<input.length; i++)
    input[i].value = '';
       
    for(var i=0; i<select.length; i++)
    select[i].selectedIndex = 0;
}

// Função para validar o CNPJ
function validarCNPJ(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g,'');

    // Elimina CNPJs inválidos conhecidos
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;
    // Fim CNPJs inválidos conhecidos
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;               
}

// Função para validar e-mail
function validarEmail(email){
    var str = email;
    var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    
    if(filtro.test(str)) {
        return true;
    } else {
        return false;
    }
}