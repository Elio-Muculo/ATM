<?php 

/* @tipo  */
function validarCampos($tipo, $campo) {
    switch ($tipo) {
        case 'email':
            if (!empty($campo) && filter_var($campo, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                throw new Exception("");
            }
            break;
        case 'int':
            if (!empty($campo) && filter_var($campo, FILTER_VALIDATE_INT)) {
                return true;
            } else {
                throw new Exception("Error Processing Request");
            }
            break;
        default:
            # code...
            break;
    }
}


