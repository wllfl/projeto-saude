<?php
require_once 'autoload.php';

class Importacao implements Base{
    
    public function __construct($conexao) {
        parent::__construct($conexao);
    }
    
    public function getAll(){
        try{
            $sql = "SELECT U.RAZAO, U.USUARIO, I.* FROM TAB_IMPORTACAO INNER JOIN TAB_USUARIO ON I.ID_USUARIO = U.ID_USUARIO";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $dados = $stm->fetchAll(PDO::FETCH_OBJ);
            
            return $dados;
        } catch (Exception $ex) {
            echo "Erro ao consultar dados: " . $ex->getMessage();
        }
    }
    
    public function getFilter($filter){
        try{
            $sql = "SELECT U.RAZAO, U.USUARIO, I.* FROM TAB_IMPORTACAO INNER JOIN TAB_USUARIO ON I.ID_USUARIO = U.ID_USUARIO WHERE U.RAZAO LIKE ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $filter.'%');
            $stm->execute();
            $dados = $stm->fetchAll(PDO::FETCH_OBJ);
            
            return $dados;
        } catch (Exception $ex) {
            echo "Erro ao consultar dados: " . $ex->getMessage();
        }
    }
    
    public function insert($array){
        try{
            $sql = "INSERT INTO TAB_IMPORTACAO(ID_USUARIO, QTDE_REGISTRO)VALUES";
            $sql .= "(?, ?)";
            $stm = $this->pdo->prepare($sql);
            $cont = 1;
            foreach ($array as $valor):
                $stm->bindValue($cont, $valor);
                $cont++;
            endforeach;
            $retorno = $stm->execute();

            return $retorno;
            
        } catch (PDOException $ex) {
            echo "Erro ao inserir dados: " . $ex->getMessage();
        }
    }
    
    public function update($array){
        try{
            $sql = "UPDATE TAB_IMPORTACAO SET ID_USUARIO=?, QTDE_REGISTRO=?";
            $sql .= "WHERE ID_IMPORTACAO = ?";
            $stm = $this->pdo->prepare($sql);
            $cont = 1;
            foreach ($array as $valor):
                $stm->bindValue($cont, $valor);
                $cont++;
            endforeach;
            $retorno = $stm->execute();
            
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao editar dados: " . $ex->getMessage();
        }
    }
    
    public function delete($id){
        try{
            $sql = "DELETE FROM TAB_IMPORTACAO WHERE ID_IMPORTACAO = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $retorno = $stm->execute();
            
            return $retorno;
        } catch (Exception $ex) {
            echo "Erro ao excluir dados: " . $ex->getMessage();
        }
    }
}