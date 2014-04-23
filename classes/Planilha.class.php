<?php

 /***************************************************************************************************
 * @author william																					*
 * Data: 20/07/2013 																				*
 * Descrição: Classe elaborada com o objetivo de auxlilar na importação de registros				*
 * oriundos de planilhas do Excel com extensão .xls, dados sendo inseridos em banco de dado MySQL.	*
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
  	* Método construtor executando construtor da classe pai
  	*/
  	public function __construct($conexao, $file, $tabela){
  		parent::__construct($conexao, $file, $tabela);
        if ($this->getColunas() != self::qtde_colunas):
            echo 'Quantidades de colunas da planilha está incorreta! aceito ' . self::qtde_colunas . ' existente ' . $this->getColunas();
            exit();
        endif;
  	}
        
    /*
     * Seta valor para o atributo histórico
     * @param $valor - Valor atribuido ao atributo
     */
    public function setHistorico($valor){
        $this->historico = $valor;
    }

    /*
	* Método que retorna dados da planilha
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
	}// Fim da função getDados

    /*
     * Método para inserir os dados na tabela Orçamento e se solicitado inserir os mesmos dados na tabela histórico
     * @return - Valor booleano baseado na verificação da quantidade solicitada de inserção x quantidade de registros inserida na tabela
     */
  	public function insertDados(){
			$this->id = $_SESSION['ID'].date('ymdHis');
			
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
				$this->msgErro .= "\n Código: " . $e->getCode() . " - Mensagem: " . $e->getMessage();
            }
            return $this->verificaOp();
            
        }// Fim da função insertDados
        
    /*
     * Método que confronta as quantidades de linhas inseridas
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
            $this->msgErro .= "\n Código: " . $e->getCode() . " - Mensagem: " . $e->getMessage();
        }
        
        if(($this->getLinhas() -2) == $reg->CONTADOR):
            $this->insertLog($this->id, $_SESSION['ID'], 'SUCESSO', $reg->CONTADOR);
            return TRUE;
        else:
            $this->insertLog($this->id, $_SESSION['ID'], 'ERRO');
            return FALSE;
        endif;
    }
}

