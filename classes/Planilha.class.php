<?php
header('Content-type: text/html; charset=utf-8');

 /***************************************************************************************************
 * @author william																					*
 * Data: 20/07/2013 																				*
 * Descri��o: Classe elaborada com o objetivo de auxlilar na importa��o de registros				*
 * oriundos de planilhas do Excel com extens�o .xls, dados sendo inseridos em banco de dado MySQL.	*
 ****************************************************************************************************/
 
require_once "../config.php";
require_once PATH . "/autoload.php";

class Planilha extends InsertPlanilha{
    
	/*
	* Propriedades da classe
	*/
    const qtde_colunas = 9;
	const primeira_linha = 3;
    private $historico = FALSE;
	private $id = null;

	/*
  	* M�todo construtor executando construtor da classe pai
  	*/
  	public function __construct($conexao, $file, $tabela, $nameFile){
  		parent::__construct($conexao, $file, $tabela, $nameFile);
        if ($this->getColunas() != self::qtde_colunas):
            echo utf8_encode("<br/><br/><span class='ms no'>Quantidades de colunas da planilha est� incorreta, aceito " . self::qtde_colunas . ' colunas existente ' . $this->getColunas() . " colunas! </span>");
			echo "<br/><br/><input type='image' name='botaoVoltar' src='/ProjetoPedro/images/btnVoltar.png' class='btnImagem' onclick='window.location=\"/ProjetoPedro/upload-planilha\"' title='P�gina principal'/>";
            exit();
        endif;
  	}
        
    /*
     * Seta valor para o atributo hist�rico
     * @param $valor - Valor atribuido ao atributo
     */
    public function setHistorico($valor){
        $this->historico = $valor;
    }

    /*
	* M�todo que retorna dados da planilha
	* @return = Linhas e colunas da planilha
	*/
	public function getDados(){
		$retorno = '';
		$retorno .= 'Total de linhas: ' . $this->getLinhas() . ' - Total de colunas: ' . $this->getColunas() . "<br>";
		$retorno .= '*****************************************************************************' . "<br>";

		foreach($this->dataSheet->rows() as $chave => $valor):
            if ($chave >= self::primeira_linha -1):		
				 $retorno .= "Linha " . $this->getLinhas() ." - ";
				 $retorno .= "PATOLOGIA: " . trim($valor[1]) . " - ";
				 $retorno .= "FAIXA ETARIA: " . trim($valor[2]) . " - ";
				 $retorno .= "SEXO: " . trim($valor[3]) . " - ";
				 $retorno .= "DESCONHECE: " . trim($valor[4]) . " - ";
				 $retorno .= "SIM: " . trim($valor[5]) . " - ";
				 $retorno .= "TRATAMENTO: " . trim($valor[6]) . " - ";
				 $retorno .= "HISTORICO: " . trim($valor[7]) . " - ";
				 $retorno .= "NAO: " . trim($valor[8]) . " <br />";
				 $retorno .= '*****************************************************************************' . "<br>";
			 endif;
		endforeach;// Fim do loop para linhas
		
		return $retorno;
	}// Fim da fun��o getDados

    /*
     * M�todo para inserir os dados na tabela Or�amento e se solicitado inserir os mesmos dados na tabela hist�rico
     * @return - Valor booleano baseado na verifica��o da quantidade solicitada de inser��o x quantidade de registros inserida na tabela
     */
  	public function insertDados(){
			$this->id = $_SESSION['ID'].date('ymdHis');
			
			if($this->getContadorImportacao($_SESSION['ID']) >= 12):
				$sqlDel = "DELETE FROM TAB_PLANILHA ";
				$sqlDel .= "WHERE ID_USUARIO = ? AND (CAST(DATA AS DATE)) = ";
				$sqlDel .= "(SELECT MIN(CAST(DATA_IMPORTACAO AS DATE)) FROM TAB_IMPORTACAO WHERE ID_USUARIO = ?)";
				$stm = $this->pdo->prepare($sqlDel);
				$stm->bindValue(1, $_SESSION['ID']);
				$stm->bindValue(2, $_SESSION['ID']);
				$stm->execute();

				$sqlDel = "DELETE FROM TAB_IMPORTACAO ";
				$sqlDel .= "WHERE ID_USUARIO = ? ORDER BY DATA_IMPORTACAO LIMIT 1 ";
				$stm = $this->pdo->prepare($sqlDel);
				$stm->bindValue(1, $_SESSION['ID']);
				$stm->execute();
			endif;

			try{
				$sql = "INSERT INTO TAB_PLANILHA (ID_OPERACAO, ID_USUARIO, PATOLOGIA, FAIXA_ETARIA, SEXO, QTDE_D, QTDE_S, QTDE_N, QTDE_T, QTDE_H) ";
				$sql .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$stm = $this->pdo->prepare($sql);
				
				foreach($this->dataSheet->rows() as $chave => $valor):
					if ($chave >= (self::primeira_linha-1)):		
						$patologia  = trim($valor[1]);
						$faixa      = trim($valor[2]);
						$sexo       = trim($valor[3]);
						$desconhece = trim($valor[4]);
						$sim        = trim($valor[5]);
						$tratamento = trim($valor[6]);
						$historico  = trim($valor[7]);
						$nao        = trim($valor[8]);
						 
						$stm->bindValue(1, $this->id);
						$stm->bindValue(2, $_SESSION['ID']);
						$stm->bindValue(3, $patologia);
						$stm->bindValue(4, $faixa);
						$stm->bindValue(5, $sexo);
						$stm->bindValue(6, $desconhece);
						$stm->bindValue(7, $sim);
						$stm->bindValue(8, $nao);
						$stm->bindValue(9, $tratamento);
						$stm->bindValue(10, $historico);
						$stm->execute();
					 endif;
				endforeach;// Fim do loop para linhas
				
			}catch (Exception $e){
				$this->msgErro .= "\n C�digo: " . $e->getCode() . " - Mensagem: " . $e->getMessage();
            }
            return $this->verificaOp();
            
        }// Fim da fun��o insertDados
        
    /*
     * M�todo que confronta as quantidades de linhas inseridas
     * e a quantidade de linhas na planilha
     * @return = Valor booleano 
     */
    protected function verificaOp(){
        try{
            $sql = "SELECT COUNT(*) AS CONTADOR FROM " . $this->tabela . " WHERE ID_OPERACAO = " . $this->id;
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $reg = $stm->fetch(PDO::FETCH_OBJ);
        }  catch (Exception $e){
            $this->msgErro .= "\n C�digo: " . $e->getCode() . " - Mensagem: " . $e->getMessage();
        }
        
        if(($this->getLinhas() -2) == $reg->CONTADOR):
            $this->insertLog($this->id, $_SESSION['ID'], 'SUCESSO', $reg->CONTADOR);
            return TRUE;
        else:
            $this->insertLog($this->id, $_SESSION['ID'], 'ERRO');
            return FALSE;
        endif;
    }

     /*
     * M�todo para contar a quantidade de importa��es feitar por um usu�rio
     * @param $idUsuario - Id do usu�rio 
     * @return - Valor inteiro com  quantidade de importa��es 
     */
    public function getContadorImportacao($idUsuario){
        try{
            $sql = "SELECT COUNT(*) AS CONTADOR FROM TAB_IMPORTACAO ";
            $sql .= "WHERE ID_USUARIO = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $idUsuario);
            $stm->execute();
            $valor = $stm->fetch(PDO::FETCH_OBJ);
            
            return $valor->CONTADOR;
        } catch (Exception $ex) {
            echo "Erro ao consultar dados: " . $ex->getMessage();
        }
    }
}

