<?php
require_once "SimpleXLSX.class.php";
//error_reporting(E_ALL ^ E_NOTICE);

abstract class InsertPlanilha{

	// Atributos da classe
	protected $name_file = null;
	protected $dataSheet = null;
	protected $pdo 	     = null;
	protected $extensao  = 'xlsx';
    protected $tabela    = null;
    protected $msgErro   = null;
	protected $linhas    = null;
	protected $colunas   = null;

    /*
	* Método construtor da classe
	* @param $conexao = Conexão com o banco de dados
	* @param $file    = Endereço e nome da planilha
	* @param $tabela  = Tabela para inserir os dados
	*/
	public function __construct($conexao, $file, $tabela){
		if ($conexao != null) $this->pdo = $conexao;
                if ($tabela  != null) $this->tabela = $tabela;

		if ($file != null && $this->existsExtensao($file)){
			$this->name_file = $file;
			//$this->dataSheet = new Spreadsheet_Excel_Reader($file);
			$this->dataSheet = new SimpleXLSX($file);
			list($this->colunas, $this->linhas) = $this->dataSheet->dimension();
		}else{
			echo "Arquivo não encontrado ou extensão inválida!";
            exit();
		}
	}

	abstract public function getDados();
	abstract public function insertDados();

	/*
	* Método para setar o atributo extensão 
	* @param = extensão do arquivo
	*/
	public function setExtensao($extensao){
		$this->extensao = $extensao;
	}

	/*
	* Método que retorna a extensão aceita
	* @return = string com a extensão 
	*/
	public function getExtensao(){
		return $this->extensao;
	}

	/*
	* Método para verificar extensão do arquivo 
    * @param $file - String contendo o endereço da planilha
	* @return = TRUE 
	*/
	public function existsExtensao($file){
		$retorno = true;
		$str = substr($file, -4);
		if ($str == $this->extensao) $retorno = true;

		return $retorno;
	}

	/*
	* Método que retorna o número de linhas na planilha
	* @return = Quantidade de linhas da planilha
	*/
	public function getLinhas(){
		return $this->linhas;
	}

	/*
	* Método que retorna o número de colunas na planilha
	* @return = Quantidade de colunas da planilha
	*/
	public function getColunas(){
		return $this->colunas;
	}

	/*
	* Método para substituir somente o primeira ocorrência de um valor
    * @param $search  - Valor a ser pesquisado
    * @param $replace - Novo valor a ser substituido
    * @param $subject - String inteira
	* @return = String modificada
	*/
	private function str_replace_once($search, $replace, $subject){
		if(($pos = strpos($subject, $search)) !== false){
			$ret = substr($subject, 0, $pos).$replace.substr($subject, $pos + strlen($search));
		}else{
			$ret = $subject;
		}
		return($ret);
	}

	/*
	* Método para verifcar existência de um registro no banco
        * @param $tabela - Tabela a ser pesquisada
        * @param $campo  - Campo que vai compor a cláusula where
        * @param $valor  - Valor a ser pesquisado na tabela
	* @return = Quantidade de registros encontrados
	*/
	private function VerificaRegistro($tabela, $campo, $valor) {
		$sql = "SELECT * FROM $tabela WHERE  $campo = ?";
		$stm = $this->pdo->prepare($sql);
		$stm->bindValue(1, $valor);
		$stm->execute();
		$retorno = $stm->rowCount();

		return $retorno;
	}

	/*
	* Método para alterar acentução
        * @param $valor - String a ser alterada
	* @return = String modificada
	*/
	private function AlteraAcento($valor) {
	    $valor = str_replace('á', 'Á', $valor);
	    $valor = str_replace('ã', 'Ã', $valor);
	    $valor = str_replace('à', 'À', $valor);
	    $valor = str_replace('â', 'Â', $valor);
	    $valor = str_replace('é', 'É', $valor);
	    $valor = str_replace('ê', 'Ê', $valor);
	    $valor = str_replace('í', 'Í', $valor);
	    $valor = str_replace('ó', 'Ó', $valor);
	    $valor = str_replace('ô', 'Ô', $valor);
	    $valor = str_replace('õ', 'Õ', $valor);
	    $valor = str_replace('ú', 'Ú', $valor);
	    $valor = str_replace('ü', 'Ü', $valor);
	    $valor = str_replace('ç', 'Ç', $valor);

	    return $valor;
	}
        
        /*
         * Método para inserir o log de importação 
         * @param $user   = Nome do usuário que executou a importação
         * @param $status = Status da importatação ('SUCESSO' ou 'ERRO')
         */        
        public function insertLog($id=null, $user=null, $status=null, $registros=null){
            try{
                $sql = "INSERT INTO TAB_IMPORTACAO (ID_USUARIO, QTDE_REGISTRO, STATUS, MSG, ID_OPERACAO)VALUES(?, ?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $user);
			    $stm->bindValue(2, $registros);
                $stm->bindValue(3, $status);
                $stm->bindValue(4, $this->msgErro);
				$stm->bindValue(5, $id);
                $stm->execute();
            }  catch (Exception $e){
                $this->msgErro .= "\n Código: " . $e->getCode() . " - Mensagem: " . $e->getMessage();
            }
        }
        
        /*
         * Método para limpar a tabela antes da inserção dos dados
         * @param $tabela - Nome da tabela a ser limpa
         * @return - Valor booleano indicando sucesso ou erro na operação de exclusão
         */
        protected function limpaTabela(){
            try{
                $sql = "DELETE FROM " . $this->tabela;
                $stm = $this->pdo->prepare($sql);
                $retorno = $stm->execute();
            }  catch (Exception $e){
                $this->msgErro .= "\n Código: " . $e->getCode() . " - Mensagem: " . $e->getMessage();
            }
            
            return $retorno;
        }
}