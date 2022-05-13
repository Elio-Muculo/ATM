<?php
session_start();

require_once 'validator.php';
require_once 'crud.php';

$campos = array('string' => $_POST['operadora'], 'int' => $_POST['cel'], 'int' => $_POST['valor']);

foreach ($campos as $key => $value) {
    if (validarCampos($key, $value)) {
        $telefone = $_POST['cel'];
        $operadora = $_POST['operadora'];
        $valor = $_POST['valor'];
    }
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['saldo'])) {
        // valor levantar + 10 devido a taxa de recarga.
        if (!($valor + 10 > $_SESSION['saldo'])) {
            if (validarNumero($telefone, $operadora)) {
                $_SESSION['saldo'] = $_SESSION['saldo'] - $valor;
                $_SESSION['saldo'] -= 10;
                $recarga = gerarCodigoRecarga(14);
                $sql = "INSERT INTO credito (recarga, data_recarga, id_cliente) VALUES (:codigo, :data_compra, :id)";
                $dados =  ['codigo' => $recarga, 'data_compra' => date("Y-m-d H:i:s"), 'id' => intval($_SESSION['id_user'])];
                if (insertAll($sql, $dados) == 1) {
                    setcookie("recarga", $recarga, 0, '/');
                    setcookie("operadora", $operadora, 0, '/');
                    header('Location: ../recarga.php');
                    exit(200);
                }
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

