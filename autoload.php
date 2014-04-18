<?php

 function loaderClass($classe){        
 	if (file_exists("classes/" . $classe . ".class.php")):
            require_once "classes/" . $classe. ".class.php";
 	else:
            echo "Arquivo não encontrado: classes/{$classe}.class.php";
 	endif;
 }
 
spl_autoload_register('loaderClass');


