<?php 
require_once 'validator.php';
require_once 'crud.php';
session_start();

$campos = array('int' => $_POST['contador'], 'int' => $_POST['valor']);

foreach ($campos as $key => $value) {
    if (validarCampos($key, $value)) {
        $valor = $_POST['valor'];
        $valor = $valor + 10;
        $contador = $_POST['contador'];
    }
}

$id = $_SESSION['id_user']; 
$sql = "SELECT * FROM saldo WHERE id_cliente = :id";
$saldo = saldo($sql, [':id' => $id]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (array_key_exists('saldo', $saldo)) {
        // valor levantar + 10 devido a taxa de recarga.
        if (!($valor > $saldo['saldo'])) {
            if (validarNumeroContador($contador)) {
                
                levantar("UPDATE saldo SET saldo = saldo - :levantar WHERE id_cliente = :id", [':levantar' => $valor, 'id' => $_SESSION['id_user']]);
                $recarga = gerarCodigoCredelec(14);
                $sql = "INSERT INTO movimento (tipo_operacao, valor, data_movimento, id_cliente) VALUES (:tipo, :valor, :data_compra, :id)";
                $dados =  ['tipo' => "credelec", 'valor' => $valor, 'data_compra' => date("Y-m-d H:i:s"), 'id' => intval($_SESSION['id_user'])];
               
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
