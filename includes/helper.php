<?php 


/**
 * calcular o tempo e fazer contagem decrescente com base 
 * na hora actual e o tempo fornecido de bloqueio
 * 
 * @param int 
 * - o tempo que a conta estara bloqueada em segundos
 * 
 * @return int retorna o tempo em segundos que falta para desbloquear a conta
**/
function tempoBloqueioConta($tempo) {
    if(!isset($_SESSION['countdown'])){
        
        $_SESSION['countdown'] = $tempo;
        $_SESSION['time_started'] = time();
    }

    $now = time();


    $timeSince = $now - $_SESSION['time_started'];

    $remainingSeconds = $_SESSION['countdown'] - $timeSince;

    return $remainingSeconds;
}



/**
 * 
 * @param int $lenght 
 * tamanho da recarga a ser gerada
 * 
 * @return int 
 * a recarga de credito
 */
function gerarCodigoRecarga($lenght) {
    $char = "1234567890";
    $charLenght = strlen($char);
    $codigo = '';
    for ($i = 0; $i < $lenght; $i++) {
        // dar espaço no numero recarga a cada 4 digitos
        if (strlen($codigo) == 3 || strlen($codigo) == 8 || strlen($codigo) == 13) {
            $codigo .= $char[random_int(0, $charLenght - 1)] . "\n";
        } 
        $codigo .= $char[random_int(0, $charLenght - 1)];
    }
    return $codigo;
}

/**
 * bloqueia uma conta quando o seu estado é 0 por 3 horas
 * 
 * @param int $numero
 * numero de telefone a ser validado
 * 
 * @param string $operadora
 * a operadora correspondente
 * 
 * @return boolean 
 * true em caso do numero for valido.
 */
function validarNumero($numero, $operadora) {
    switch ($operadora) {
        case 'vodacom':
            if (preg_match('/^\+(258)-(84|85)\d{7}$/', $numero)) {
                if (filter_var($numero, FILTER_SANITIZE_NUMBER_INT)) {
                    return true;
                }
            } else {
                return false;
            }
            break;
        case 'tmcel':
            if (preg_match('/^\+(258)-(82|83)\d{7}$/', $numero)) {
                if (filter_var($numero, FILTER_SANITIZE_NUMBER_INT)) {
                    return true;
                }
            } else {
                return false;
            }
            break;
        case 'movitel':
            if (preg_match('/^\+(258)-(86|87)\d{7}$/', $numero)) {
                if (filter_var($numero, FILTER_SANITIZE_NUMBER_INT)) {
                    return true;
                }
            } else {
                return false;
            }
            break;
        default:
            'Operadora inexistente';
            break;
    }
}



/**
 * * verificar se o numero fornecido é valido deve ser 12 digitos..
 * 
 * @param int $numero
 * tamanho do numero do credelec
 * 
 * @return true
 * boolean caso numero da conta tiver tamanho 12. 
 * 
 */
function validarNumeroContador($numero = 0) {
    if (validarCampos('int', $numero)) {
        if (strlen(strval($numero)) == 12) {
            return true;
        }
    }
}


/**
 * * gerar codigo recarga de contador com 16 digitos
 * 
 * @param int $lenght
 * tamanho do numero a ser gerado
 * 
 * @return int
 *  A recarga do contador
 * 
 */
function gerarCodigoCredelec($lenght = 0) {
    $char = "1234567890";
    $charLenght = strlen($char);
    $codigo = '';
    for ($i = 0; $i < $lenght; $i++) {
        // dar espaço no numero recarga a cada 4 digitos
        if (strlen($codigo) == 3 || strlen($codigo) == 8 || strlen($codigo) == 13) {
            $codigo .= $char[random_int(0, $charLenght - 1)] . "\n";
        } 
        $codigo .= $char[random_int(0, $charLenght - 1)];
    }
    return $codigo;
}
