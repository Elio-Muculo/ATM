<?php 

/* @tipo  */
function validarCampos($tipo, $campo) {
    trim($campo); // remover espacos
	htmlentities($campo); // escapar caracteres especiais
	stripslashes($campo); // remove \ do input

    switch ($tipo) {
        case 'email':
            if (!empty($campo) && filter_var($campo, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                throw new Exception("");
            }
            break;
        case 'string':
            $data = isset($data) ? filter_var($data, FILTER_SANITIZE_STRING) : false;
            break;
        case 'int':
            if (!filter_var($campo, FILTER_VALIDATE_INT) === false) {
                return true;
            } else {
                throw new Exception("campo invalido");
            }
            break;
        default:
            "tipo de dados incompativel";
            break;
    }
}


