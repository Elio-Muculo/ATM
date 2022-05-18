<?php 

/**
 * 
 * TODO fornecer documentacao do metodo
 **/
 function validarCampos($tipo, $campo) {
    trim($campo); // remover espacos
	htmlentities($campo); // escapar caracteres especiais
	stripslashes($campo); // remove \ do input

    switch ($tipo) {
        case 'email':
            if (!empty($campo) && filter_var($campo, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                return false;
            }
            break;
        case 'string':
            $data = isset($data) &&  !empty($data) ? strval($data) : false;
            break;
        case 'int':
            if (!filter_var($campo, FILTER_VALIDATE_INT) === false) {
                return true;
            } else {
                return false;
            }
            break;
        default:
            "tipo de dados incompativel";
            break;
    }
}


