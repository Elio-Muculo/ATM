<?php 

/**
 * 
 * @param string $tipo 
 * tipo de dado do input 
 * 
 * @param mixed $campo 
 * input do campo a ser validado
 * 
 * @return boolean
 **/
function validarCampos($tipo = '', $campo) {
    $campo = trim((string) $campo); // remover espacos
    $campo = stripslashes($campo); // adiciona \ do input
    $campo = htmlspecialchars($campo, ENT_QUOTES, 'UTF-8'); // escapar caracteres especiais

    switch ($tipo) {
        case 'email':
            return !empty($campo) && filter_var($campo, FILTER_VALIDATE_EMAIL);
        case 'string':
            return $campo !== '';
        case 'int':
            return filter_var($campo, FILTER_VALIDATE_INT) !== false;
        default:
            "tipo de dados incompativel";
            return false;
    }
}

