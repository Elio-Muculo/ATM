<?php
session_start();
require_once 'crud.php';
require_once 'validator.php';
require_once 'acesso_negado.php';



// tentativas inicia com zero caso nao exista.
if (!isset($_SESSION['att'])) {
    $_SESSION['att'] = 0;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = [];
    $numero_conta = $_POST['user'];
    $pin = $_POST['pin'];
    
    if (!empty($numero_conta) && !empty($pin)) {
        $sql = "SELECT * FROM usuario WHERE numero_conta = :numero AND estado = :estado";
        $countExist = countRow($sql, [':numero' => $numero_conta, ':estado' => 1]);
        if ($countExist > 0) {
            $sql = "SELECT senha FROM usuario WHERE numero_conta = :numero";
            $hashed_pass = readOne($sql, ['numero' => $numero_conta]);
            $pin = password_verify($pin, $hashed_pass['senha']) ? $hashed_pass['senha'] : '';
           
            
            $sql = "SELECT * FROM usuario WHERE numero_conta = :numero AND senha = :pin"; 
            $accountChecked = countRow($sql, [':numero' => $numero_conta, ':pin' => $pin]);

            if ($accountChecked == 1) {
                $dados = readOne($sql, [':numero' => $numero_conta, ':pin' => $pin]);
				$_SESSION['logado'] = true;
				$_SESSION['id_user'] = $dados['id'];
				header('Location: ../saldo.php');
				exit;
            } else {

                // Quando tentativas guardadas na sessao forem 3
                // inicializa com 0 e redireciona para pagina com acesso negado.
                if ($_SESSION['att'] > 1) {
                    // bloquear conta do usuario por 3h
                    
                    $sql = "SELECT * FROM usuario WHERE numero_conta = :numero"; 
                    $dados = readOne($sql, [':numero' => $numero_conta]);
                    changeUserState("UPDATE usuario SET estado = 0 WHERE id = :id", ['id' => $dados['id']]);


                    $error[] = "<p>A conta foi bloqueada por 3 horas.</p>";
                    $_SESSION['error'] = $error;
                    header('Location: ../index.php');
                    exit;
                }

                // incrementar as tentativas ate 3.
                $_SESSION['att'] += 1;

                $error[] = "O numero da conta ou password devem estar incorrectos.";
                $_SESSION['error'] = $error;
                header('Location: ../index.php');
                exit;
            }
        } else {
            $sql = "SELECT * FROM usuario WHERE numero_conta = :numero AND estado = :estado";
            $dados = readOne($sql, ['numero' => $numero_conta, 'estado' => 0]);
            bloquearConta($dados);
            
            $error[] = "O usuario está com conta bloqueada";
            $_SESSION['error'] = $error;
            header('Location: ../index.php');
            exit;
        }
    }
}


// if ($_SESSION['conta_negada'] == $_POST['user']) {
//     $error[] = "Conta bloqueada, a conta será desbloqueada daqui a 3 horas.";
//     $_SESSION['error'] = $error;
//     header('Location: ../index.php?'.$_SESSION['conta_negada']);
//     exit();
// } 




// //! 3 tentativas para crendecias correctas

// if(($numero_conta == ((int)$_POST['user'])) && ($pin == ((int)$_POST['pin']))) {
//     $sucess = "bem - vindo, caro cliente. pode efectuar as suas operações.";
//     $_SESSION['sucess'] = $sucess;
//     $_SESSION['attemps'] = 0;
//     unset($_SESSION['conta_negada']);
//     header('Location: ../saldo.php');
//     exit;
// } else {
//     // Quando tentativas guardadas na sessao forem 3
//     // inicializa com 0 e redireciona para pagina com acesso negado.
//     if ($_SESSION['attemps'] > 1 && !isset($_SESSION['conta_negada'])) {
//         // bloquear conta do usuario por 3h
//         $_SESSION['conta_negada'] = isset($_POST['user']) ? $_POST['user'] : '';
//         $error[] = "<p>Atingiu o limite de 3 tentativas</p>";
//         $_SESSION['error'] = $error;
//         header('Location: ../index.php');
//         exit;
//     }

//     // incrementar as tentativas ate 3.
//     $_SESSION['attemps'] += 1;
    
//     // redireciona para login para que tente mais uma vez.
//     $error[] = "Numero da conta/Pin devem estar incorrectos";
//     $_SESSION['error'] = $error;
//     header('Location: ../index.php?'.$_SESSION['conta_negada']);
//     exit;

// // }

