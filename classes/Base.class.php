<?php
session_start();

abstract class Base{
    
    protected $pdo = null;
    
    public function __construct($conexao) {
        if (!empty($conexao)):
            $this->pdo = $conexao;
        else:
            exit();
        endif; 
    }
    
    public abstract function insert($array);
    public abstract function update($array);
    public abstract function delete($id);
    public abstract function getAll();
    public abstract function getFilterId($id);
    
}
