<?php 


function validarNumeroTelefone($numero) {
    if (preg_match('/^\+(258)-(82|83|84|85|86|87)\d{7}$/', $numero)) {
        if (filter_var($numero, FILTER_SANITIZE_NUMBER_INT)) {
            return true;
        }
    } 
}

// validarNumeroTelefone(842644623);

// +258-828243125
