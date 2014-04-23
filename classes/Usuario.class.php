<?php
//require_once "../config.php";
require_once PATH . "/autoload.php";
require_once PATH . "/funcoes.php";

class Usuario extends Base{
    
    public function __construct($conexao) {
        parent::__construct($conexao);
    }
    
    public static function validaUsuario($email, $senha, $pdo){
        try{
            $sql = "SELECT * FROM TAB_USUARIO WHERE EMAIL = ? AND SENHA = ?";
            $stm = $pdo->prepare($sql);
            $stm->bindValue(1, $email);
            $stm->bindValue(2, base64_encode($senha));
            $stm->execute();
            $linhas = $stm->rowCount();
            
            if ($linhas > 0):
                $dados = $stm->fetch(PDO::FETCH_OBJ);
                $_SESSION['ID']          = $dados->ID_USUARIO;
                $_SESSION['RAZAO']       = $dados->RAZAO;
                $_SESSION['RESPONSAVEL'] = $dados->RESPONSAVEL;
                $_SESSION['EMAIL']       = $dados->EMAIL;
                $_SESSION['CNPJ']        = $dados->CNPJ;
				if($dados->STATUS == 'A'):
					$_SESSION['ATIVO'] = TRUE;
				else:
					$_SESSION['ATIVO'] = FALSE;
				endif;				
                $_SESSION['LIBERADO']    = TRUE;
            else:
                $_SESSION['LIBERADO']    = FALSE;
            endif;

        } catch (PDOException $ex) {
            echo "Erro ao validar dados do login: " . $ex->getMessage();
        }
    }


    public function getAll(){
        try{
            $sql = "SELECT * FROM TAB_USUARIO";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $dados = $stm->fetchAll(PDO::FETCH_OBJ);
            
            return $dados;
        } catch (Exception $ex) {
            echo "Erro ao consultar dados: " . $ex->getMessage();
        }
    }
    
    public function getFilterId($id){
        try{
            $sql = "SELECT * FROM TAB_USUARIO WHERE ID_USUARIO = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->execute();
            $dados = $stm->fetch(PDO::FETCH_OBJ);
            
            return $dados;
        } catch (Exception $ex) {
            echo "Erro ao consultar dados: " . $ex->getMessage();
        }
    }
    
    public function insert($array){
        try{
            $tabela = "TAB_USUARIO";
            $coluna = "RAZAO";
            $campo = array("RAZAO", "EMAIL");
            
            if (VerificaDuplicidade($tabela, $coluna, $campo) <= 0):
                $sql = "INSERT INTO TAB_USUARIO(RAZAO, CNPJ, FONE, RESPONSAVEL, EMAIL, SENHA, STATUS)VALUES";
                $sql .= "(?, ?, ?, ?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $cont = 1;
                foreach ($array as $valor):
                    $stm->bindValue($cont, $valor);
                    $cont++;
                endforeach;
                $retorno = $stm->execute();

                return $retorno;
            else:
                return false;
            endif;
            
        } catch (PDOException $ex) {
            echo "Erro ao inserir dados: " . $ex->getMessage();
        }
    }
    
    public function update($array){
        try{
            $sql = "UPDATE TAB_USUARIO SET RAZAO=?, CNPJ=?, FONE=?, RESPONSAVEL=?, EMAIL=?, SENHA=?, STATUS=? ";
            $sql .= "WHERE ID_USUARIO = ?";
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
            $sql = "DELETE FROM TAB_USUARIO WHERE ID_USUARIO = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $retorno = $stm->execute();
            
            return $retorno;
        } catch (Exception $ex) {
            echo "Erro ao excluir dados: " . $ex->getMessage();
        }
    }
}
