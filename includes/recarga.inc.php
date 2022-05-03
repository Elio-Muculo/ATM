<?php
session_start();

require_once 'validator.php';

$campos = array('string' => $_POST['operadora'], 'int' => $_POST['cel'], 'int' => $_POST['valor']);

foreach ($campos as $key => $value) {
    if (validarCampos($key, $value)) {
        $telefone = $_POST['cel'];
        $operadora = $_POST['operadora'];
    }
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['saldo'])) {
        // valor levantar + 10 devido a taxa de recarga.
        if (!($valor + 10 > $_SESSION['saldo'])) {
            if (validarNumero($telefone)) {
                $_SESSION['saldo'] = $_SESSION['saldo'] - $valor;
                $_SESSION['saldo'] -= 10;
                $recarga = gerarCodigoRecarga(14);
                setcookie("recarga", $recarga, 0, '/');
                setcookie("operadora", $operadora, 0, '/');
                header('Location: ../recarga.php');
                exit(200);
            } else {
                $error =  "forneça um numero de telefone válido.";
                $_SESSION['erro'] = $error;
                header('Location: ../recarga.php');
                exit();
            }
        } else {
            $error =  "saldo da conta é insuficiente para a compra.";
            $_SESSION['erro'] = $error;
            header('Location: ../recarga.php');
            exit;
        }
    }  else {
       echo "sem saldo";
    }  
}



// gerar codigo de 16 numeros de credelec.
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


function validarNumero($numero) {
    if (preg_match('/^\+(258)-(82|83|84|85|86|87)\d{7}$/', $numero)) {
        if (filter_var($numero, FILTER_SANITIZE_NUMBER_INT)) {
            return true;
        }
    } 
}