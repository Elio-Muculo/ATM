<?php
session_start();
require_once 'acesso_negado.php';

// tentativas inicia com zero caso nao exista.
if (!isset($_SESSION['att'])) {
    $_SESSION['att'] = 0;
}

$numero_conta = 123;
$pin = 1234;


if ($_SESSION['conta_negada'] == $_POST['user']) {
    $error[] = "Conta bloqueada, a conta será desbloqueada daqui a 3 horas.";
    $_SESSION['error'] = $error;
    header('Location: ../index.php?'.$_SESSION['conta_negada']);
    exit();
} 


$error = [];

//! 3 tentativas para crendecias correctas

if(($numero_conta == ((int)$_POST['user'])) && ($pin == ((int)$_POST['pin']))) {
    $sucess = "bem - vindo, caro cliente. pode efectuar as suas operações.";
    $_SESSION['sucess'] = $sucess;
    $_SESSION['attemps'] = 0;
    unset($_SESSION['conta_negada']);
    header('Location: ../saldo.php');
    exit;
} else {
    // Quando tentativas guardadas na sessao forem 3
    // inicializa com 0 e redireciona para pagina com acesso negado.
    if ($_SESSION['attemps'] > 1 && !isset($_SESSION['conta_negada'])) {
        // bloquear conta do usuario por 3h
        $_SESSION['conta_negada'] = isset($_POST['user']) ? $_POST['user'] : '';
        $error[] = "<p>Atingiu o limite de 3 tentativas</p>";
        $_SESSION['error'] = $error;
        header('Location: ../index.php');
        exit;
    }

    // incrementar as tentativas ate 3.
    $_SESSION['attemps'] += 1;
    
    // redireciona para login para que tente mais uma vez.
    $error[] = "Numero da conta/Pin devem estar incorrectos";
    $_SESSION['error'] = $error;
    header('Location: ../index.php?'.$_SESSION['conta_negada']);
    exit;

}

