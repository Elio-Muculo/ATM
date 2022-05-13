<?php 
require_once 'validator.php';
require_once 'crud.php';
session_start();

$campos = array('int' => $_POST['contador'], 'int' => $_POST['valor']);

foreach ($campos as $key => $value) {
    if (validarCampos($key, $value)) {
        $valor = $_POST['valor'];
        $contador = $_POST['contador'];
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['saldo'])) {
        // valor levantar + 10 devido a taxa de recarga.
        if (!($valor + 10 > $_SESSION['saldo'])) {
            if (validarNumeroContador($contador)) {
                $_SESSION['saldo'] = $_SESSION['saldo'] - $valor;
                $_SESSION['saldo'] -= 10;
                $recarga = gerarCodigoCredelec(14);
                $sql = "INSERT INTO credelec (codigo_recarga, data_compra, id_cliente) VALUES (:codigo, :data_compra, :id)";
                $dados =  ['codigo' => $recarga, 'data_compra' => date("Y-m-d H:i:s"), 'id' => intval($_SESSION['id_user'])];
                
                if (insertAll($sql, $dados) == 1) {
                    setcookie("recarga", $recarga, 0, '/');
                    header('Location: ../credelec.php');
                    exit(200);
                }
            } else {
                $error =  "Caro CLiente, forneça um numero de contador válido.";
                $_SESSION['error'] = $error;
                header('Location: ../credelec.php');
                exit(200);
            }
        } else {
            $error =  "saldo da conta é insuficiente para a compra.";
            $_SESSION['error'] = $error;
            header('Location: ../credelec.php');
            exit;
        }
    }  else {
       echo "sem saldo";
    }  
}


// verificar se o numero fornecido é valido deve ser 12 digitos.
function validarNumeroContador($numero) {
    if (validarCampos('int', $numero)) {
        if (strlen(strval($numero)) == 12) {
            return true;
        }
    }
}


// gerar codigo de 16 numeros de credelec.
function gerarCodigoCredelec($lenght) {
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
