<?php
session_start();
require_once 'acesso_negado.php';

if (!isset($_SESSION['att'])) {
    $_SESSION['att'] = 0;
}

$numero_conta = 123;
$pin = 1234;

if ($_SESSION['conta_negada'] === $numero_conta) {
    header('Location: ../index.php?erro=conta bloqueada');
    exit();
} 

//! 3 tentativas para crendecias correctas

if(($numero_conta == ((int)$_POST['user'])) && ($pin == ((int)$_POST['pin']))) {
    // login efectuado com sucesso
    $_SESSION['attemps'] = 0;
    header('Location: ../saldo.php');
    exit;
} else {
    // Quando tentativas guardadas na sessao forem 3
    // inicializa com 0 e redireciona para pagina com acesso negado.
    if ($_SESSION['attemps'] > 1) {
        // bloquear conta do usuario por 3h
        $_SESSION['conta_negada'] = $numero_conta;
        header('Location: ../index.php?erro=tente mais tarde');
        exit;
    }

    // incrementar as tentativas ate 3.
    $_SESSION['attemps'] += 1;
}

// redireciona para login para que tente mais uma vez.
header('Location: ../index.php');
exit;
