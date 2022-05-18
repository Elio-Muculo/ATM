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
        $valor = $valor + 10; // valor levantar + 10 devido a taxa de recarga.
    }
}

$id = $_SESSION['id_user']; 
$sql = "SELECT * FROM saldo WHERE id_cliente = :id";
$saldo = saldo($sql, [':id' => $id]);




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (array_key_exists('saldo', $saldo)) {
        if (!($valor > $saldo['saldo'])) {
            if (validarNumero($telefone, $operadora)) {
                
                $valor = $valor - 10; // salvar o valor correcto ex: 100 e, não 110 na BD.
                levantar("UPDATE saldo SET saldo = saldo - :levantar WHERE id_cliente = :id", [':levantar' => $valor, 'id' => $_SESSION['id_user']]);
                $recarga = gerarCodigoRecarga(14);
                $sql = "INSERT INTO movimento (tipo_operacao, valor, data_movimento, id_cliente) VALUES (:tipo, :valor, :data_compra, :id)";
                $dados =  ['tipo' => "recarga", 'valor' => $valor, 'data_compra' => date("Y-m-d H:i:s"), 'id' => intval($_SESSION['id_user'])];

                if (insertAll($sql, $dados) == 1) {
                    $_SESSION['recarga'] = $recarga;
                    $_SESSION['operadora'] = $operadora;
                    $_SESSION['valor'] = $valor;
                    header('Location: ../recarga.php?#mensagem');
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
            exit();
        }
    }  else {
        $error =  "indice saldo não esta definido na base dados.";
        $_SESSION['erro'] = $error;
        header('Location: ../recarga.php');
        exit();
    }  
}


 
/**
 * gerar codigo de 16 numeros de credelec.
 * TODO documentacao correcta
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
 * gerar codigo de 16 numeros de credelec.
 * TODO documentacao correcta
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

