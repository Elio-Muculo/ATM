<?php
session_start();

require_once __DIR__ .'/validator.php';
require_once __DIR__ . '/crud.php';

$campo = array('int' => $_POST['valor']);

foreach ($campo as $key => $value) {
    if (validarCampos($key, $value)) {
        $levantar = $_POST['valor'];
        $levantar = $levantar + 10; // taxa
    }
}

$id = $_SESSION['id_user']; 
$sql = "SELECT * FROM saldo WHERE id_cliente = :id";
$saldo = saldo($sql, [':id' => $id]);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (array_key_exists('saldo', $saldo)) {
        // valor levantar + 10 devido a taxa de levantamento.
        if (!($levantar > $saldo['saldo'])) {
            $retorno = levantar("UPDATE saldo SET saldo = saldo - :levantar WHERE id_cliente = :id", [':levantar' => $levantar, 'id' => $_SESSION['id_user']]);
            if ($retorno === 1) {
                $levantar =  $levantar - 10;
                $sql = "INSERT INTO movimento (tipo_operacao, valor, data_movimento, id_cliente) VALUES (:tipo, :valor, :data_compra, :id)";
                $dados =  ['tipo' => "levantamento", 'valor' => $levantar, 'data_compra' => date("Y-m-d H:i:s"), 'id' => intval($_SESSION['id_user'])];
               
                insertAll($sql, $dados);
                $_SESSION['levantado'] = $levantar;
                $_SESSION['msg'] = "Caro cliente, o seu levantamento foi efectuado com sucesso.";
                header('Location: ../levantamento.php#levantar');
                exit;
            }
        } else {
            $_SESSION['erro'] = "Caro cliente, o seu levantamento não foi efectuado, saldo negativo.";
            header('Location: ../levantamento.php');
            exit;
        }
    }  else {
        $_SESSION['erro'] = "Caro cliente, o seu levantamento não foi efectuado, saldo negativo.";
        header('Location: ../levantamento.php');
        exit;echo "sem saldo";
    }  
}

