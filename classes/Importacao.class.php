<?php
require_once PATH . "/autoload.php";

class Importacao extends Base{
    
    public function __construct($conexao) {
        parent::__construct($conexao);
    }
    
    public function getAll(){
        try{
            $sql = "SELECT U.RAZAO, U.RESPONSAVEL, I.* FROM TAB_IMPORTACAO I INNER JOIN TAB_USUARIO U ON I.ID_USUARIO = U.ID_USUARIO";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $dados = $stm->fetchAll(PDO::FETCH_OBJ);
            
            return $dados;
        } catch (Exception $ex) {
            echo "Erro ao consultar dados: " . $ex->getMessage();
        }
    }

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
    
    public function getFilterId($id){
        try{
            $where = "";
            if (!empty($id)){
                $where = "WHERE I.ID_USUARIO = ? ";
            }

            $sql = "SELECT U.RAZAO, U.RESPONSAVEL, I.ID_IMPORTACAO, DATE_FORMAT(I.DATA_IMPORTACAO , '%d/%c/%Y') AS DATA, TIME_FORMAT(I.DATA_IMPORTACAO , '%H:%i:%s') AS HORA, I.ID_OPERACAO, I.QTDE_REGISTRO ";
            $sql .= "FROM TAB_IMPORTACAO I INNER JOIN TAB_USUARIO U ON I.ID_USUARIO = U.ID_USUARIO ";
            $sql .= $where."ORDER BY ID_IMPORTACAO DESC";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->execute();
            $dados = $stm->fetchAll(PDO::FETCH_OBJ);
            
            return $dados;
        } catch (Exception $ex) {
            echo "Erro ao consultar dados: " . $ex->getMessage();
        }
    }
    
	public function insert($array){}
	public function update($array){}
	
    public function delete($id){
        try{
			$sql1 = "DELETE FROM TAB_PLANILHA WHERE ID_OPERACAO = ?";
            $stm  = $this->pdo->prepare($sql1);
            $stm->bindValue(1, $id);
            $retorno = $stm->execute();
		
            $sql2 = "DELETE FROM TAB_IMPORTACAO WHERE ID_OPERACAO = ?";
            $stm  = $this->pdo->prepare($sql2);
            $stm->bindValue(1, $id);
            $retorno = $stm->execute();
            
            return $retorno;
        } catch (Exception $ex) {
            echo "Erro ao excluir dados: " . $ex->getMessage();
        }
    }
}