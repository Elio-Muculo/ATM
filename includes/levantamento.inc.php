<?php
session_start();

if (!filter_var($_POST['valor'], 'FILTER_VALIDATE_INT') === false) {
    $levantar = $_POST['valor'];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['saldo'])) {
        // valor levantar + 10 devido a taxa de levantamento.
        if (!($levantar + 10 > $_SESSION['saldo'])) {
            $_SESSION['saldo'] = $_SESSION['saldo'] - $levantar;
            $_SESSION['saldo'] -= 10;
            header('Location: ../saldo.php?levatamento feito com sucesso');
            exit;
        } else {
            header('Location: ../saldo.php?saldo insuficiente para levantar');
            exit;
        }
    }  else {
        echo "sem saldo";
    }  
}

