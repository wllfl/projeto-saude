<?php

class Upload{
    
	/*
	* Propriedades da Classe
	*/
    private $extensoes = array('xls', 'xlsx');
    private $file = null;
    private $path = null;

	/*
	* Método construtor da Classe
	* @param $file = $_FILE[] arquivo enviado
	* @param $path = Endereço onde será gravado o arquivo
	*/
    public function __construct($file=null, $path=null) {
        $this->setFile($file);
        $this->setPath($path);
        $this->verificaErros();
    }
    
	/*
	* Método retorna os atributos do arquivo
	* return Retorna string com os atributos os arquivo
	*/
    public function getAtributos(){
        $retorno = '';
        $retorno .= "Nome: " . $this->file['name'] . "<br/>";
        $retorno .= "Tmp_name: " . $this->file['tmp_name'] . "<br/>";
        $retorno .= "Tipo: " . $this->file['type'] . "<br/>";
        $retorno .= "Erro: " . $this->file['error'] . "<br/>";
        $retorno .= "Tamanho: " . $this->file['size'];
        
        return var_dump($retorno);
    }
    
	/*
	* Método para setar o arquivo para propriedade
	* @param $file = Arquivo enviado pelo upload
	*/
    public function setFile($file){
        if ($this->existsExtensao($file['name'])):
            $this->file = $file;
        else:
            echo 'Extensão "'. substr($file, -3) . '" inválida!';
            exit();
        endif;
    }
    
	/*
	* Método para setar o caminho onde será gravado o arquivo
	* @param $path = String contendo o caminho
	*/
    public function setPath($path){
        $this->path = $path;
    }

    /*
    * Método para verificar extensão do arquivo 
	* @param $file = Arquivo enviado pelo upload
    * @return = TRUE 
    */
    public function existsExtensao($file){
        $retorno = false;
        $str = substr($file, -4);
        if (in_array($str, $this->extensoes) ) $retorno = true;

        return $retorno;
    }

	/*
    * Método para verificar erros durante o Upload
    * @return = String contendo mensagem de erro 
    */
    public function verificaErros(){
        $erro = $this->file['error'];
        $msg  = '';
        
        if ($erro != 0):
            switch ($erro) :
                case 1: {
                    $msg = "O tamanho do arquivo é maior que o limite aceito pelo PHP!";
                    break;
                }
                case 2: {
                    $msg = "O tamanho do arquivo é maior que o limite aceito pelo HTML!";
                    break;
                }
                case 3: {
                    $msg = "Upload efetuado parcialmente!";
                    break;
                }
                case 4: {
                    $msg = "Upload não efetuado!";
                    break;
                }
            endswitch;
        endif;
        
        return $msg;
    }
    
	/*
    * Método para executar o Download
    * @return = TRUE sucesso e FALSE erro
    */
    public function executaUpload(){        
        if (move_uploaded_file($this->file['tmp_name'], $this->path . 'planilha_' . $_SESSION['ID'] . '.' . $this->extensoes[1])):
            return true;
        else:
            return false;
        endif;
    }
}
