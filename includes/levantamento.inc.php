<?php
session_start();

if (!filter_var(intval($_POST['valor']), FILTER_VALIDATE_INT) === false) {
    $levantar = $_POST['valor'];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['saldo'])) {
        // valor levantar + 10 devido a taxa de levantamento.
        if (!($levantar + 10 > $_SESSION['saldo'])) {
            $_SESSION['saldo'] = $_SESSION['saldo'] - $levantar;
            $_SESSION['saldo'] -= 10;
            $_SESSION['msg'] = "Caro cliente, o seu levantamento foi efectuado com sucesso.";
            header('Location: ../levantamento.php');
            exit;
        } else {
            $_SESSION['msg'] = "Caro cliente, o seu levantamento não foi efectuado, saldo negativo.";
            header('Location: ../levantamento.php');
            exit;
        }
    }  else {
        echo "sem saldo";
    }  
}

