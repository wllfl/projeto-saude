<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";

 function loaderClass($classe){        
 	if (file_exists(PATH . DS ."classes" . DS . $classe . ".class.php")):
        require_once PATH . DS ."classes" . DS . $classe. ".class.php";
 	else:
        echo "Arquivo não encontrado: " . PATH . DS . "classes" . DS ."{$classe}.class.php";
 	endif;
 }
 
spl_autoload_register('loaderClass');


