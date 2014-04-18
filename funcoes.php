<?php
  require_once 'autoload.php';

  /* 
  * Função para verificar duplicidade de registros
  * param 1 = Tabela para Consulta
  * param 2 = Coluna de retorno
  * param 3 = array() de campos da condição
  */
  function VerificaDuplicidade($tabela, $coluna, $campo){

      $where = " WHERE";

      // Constrói condição WHERE
      foreach ($campo as $field => $value)
      {
          if (is_numeric($value)){
              $where .= " $field = $value AND";
          }else{
             if (is_string($value)){
                $where .= " $field = '$value' AND";
             }
          }   
      }

      // Retira string se a última palavra for 'AND'
      if (substr($where, -3) == 'AND'){
          $where = trim(substr($where, 0, (strlen($where) - 3)));
      }
      
      $sql = "SELECT $coluna FROM $tabela " . $where;
      $pdo = Conectar();
      $stm = $pdo->prepare($sql);
      $stm->execute();
      $cont = $stm->rowCount();
      
      return $cont;
   }

   //Função para converter data para o formato brasileiro 30/11/2012 
   function DataToBr($data){
       if (!empty($data)){
           $data = explode("-", $data);
           return $data[2].'/'.$data[1].'/'.$data[0];
       }
   }

   //Função para converter data para o formato americano 2012-11-30
   function DataToEng($data){
       if (!empty($data)){
           $data = explode("/", $data);
           return $data[2].'-'.$data[1].'-'.$data[0];
       }
   }
   
   // Função genérica para validação de campos
   function ValidaCampos(){
        $retono = true;
        foreach ($_POST as $campo => $valor)
        {
           if (empty($valor)){
               $retono = false;
           }
        }
        return $retono;
    }
    
    // Função para substituir palavras com acento em maiúscula
    function AlteraAcento($valor) {
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
    
?>