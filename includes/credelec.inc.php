<?php 
session_start();
require_once __DIR__ . '/helper.php';
require_once __DIR__ . '/validator.php';
require_once __DIR__ . '/crud.php';


$campos = array('int' => $_POST['contador'], 'int' => $_POST['valor']);

/**
 * validar os campos do input
 */
foreach ($campos as $key => $value) {
    if (validarCampos($key, $value)) {
        $valor = $_POST['valor'];
        $valor = $valor + 10; // valor levantar + 10 devido a taxa de recarga.
        $contador = $_POST['contador'];
    }
}

$id = $_SESSION['id_user']; 
$sql = "SELECT * FROM saldo WHERE id_cliente = :id";
$saldo = saldo($sql, [':id' => $id]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (array_key_exists('saldo', $saldo)) {
        if (!($valor > $saldo['saldo'])) {
            if (validarNumeroContador($contador)) {
                levantar("UPDATE saldo SET saldo = saldo - :levantar WHERE id_cliente = :id", [':levantar' => $valor, 'id' => $_SESSION['id_user']]);
                $valor = $valor - 10; // salvar o valor correcto ex: 100 e, não 110 na BD
                $recarga = gerarCodigoCredelec(14);
                $sql = "INSERT INTO movimento (tipo_operacao, valor, data_movimento, id_cliente) VALUES (:tipo, :valor, :data_compra, :id)";
                $dados =  ['tipo' => "credelec", 'valor' => $valor, 'data_compra' => date("Y-m-d H:i:s"), 'id' => intval($_SESSION['id_user'])];
               
                if (insertAll($sql, $dados) == 1) {
                    $_SESSION['recarga'] = $recarga;
                    $_SESSION['numero'] = $contador;
                    $_SESSION['valor'] = $valor;
                    header('Location: ../credelec.php#credelec');
                    exit(200);
                }
            } else {
                $error =  "Caro Cliente, forneça um numero de contador válido.";
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
        $error =  "indice saldo indefinido na base dados.";
        $_SESSION['error'] = $error;
        header('Location: ../credelec.php');
        exit;
    }  
}


