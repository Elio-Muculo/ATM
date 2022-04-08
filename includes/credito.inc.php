<?php 

function validarNumeroTelefone($numero) {
    if (preg_match('/^[0-9]{9}]+$/', $numero)) {
        if (filter_var($numero, FILTER_SANITIZE_NUMBER_INT)) {
            return true;
        }
    }
}

validarNumeroTelefone(842644623);