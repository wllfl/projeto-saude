<?php

class Upload{
    
    private $extensoes = array('xls');
    private $file = null;
    private $path = null;

    public function __construct($file=null, $path=null) {
        $this->setFile($file);
        $this->setPath($path);
        $this->verificaErros();
    }
    
    public function getAtributos(){
        $retorno = '';
        $retorno .= "Nome: " . $this->file['name'] . "<br/>";
        $retorno .= "Tmp_name: " . $this->file['tmp_name'] . "<br/>";
        $retorno .= "Tipo: " . $this->file['type'] . "<br/>";
        $retorno .= "Erro: " . $this->file['error'] . "<br/>";
        $retorno .= "Tamanho: " . $this->file['size'];
        
        return var_dump($retorno);
    }
    
    public function setFile($file){
        if ($this->existsExtensao($file['name'])):
            $this->file = $file;
        else:
            echo 'Extensão "'. substr($file, -3) . '" inválida!';
            exit();
        endif;
    }
    
    public function setPath($path){
        $this->path = $path;
    }

    /*
    * Método para verificar extensão do arquivo 
    * @return = TRUE 
    */
    public function existsExtensao($file){
        $retorno = false;
        $str = substr($file, -3);
        if (in_array($str, $this->extensoes) ) $retorno = true;

        return $retorno;
    }

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
    
    public function executaUpload(){        
        if (move_uploaded_file($this->file['tmp_name'], $this->path . 'planilha.' . $this->extensoes[0])):
            return true;
        else:
            return false;
        endif;
    }
}
