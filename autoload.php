<?php
require_once 'config.php';

 function loaderClass($classe){        
 	if (file_exists(PATH ."/classes/" . $classe . ".class.php")):
            require_once PATH . "/classes/" . $classe. ".class.php";
 	else:
            echo "Arquivo não encontrado: " . PATH . "/classes/{$classe}.class.php";
 	endif;
 }
 
spl_autoload_register('loaderClass');


