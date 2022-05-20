<?php
session_start();
require_once __DIR__ . '/crud.php';
require_once __DIR__ . '/validator.php';
require_once __DIR__ . '/acesso_negado.php';

 
date_default_timezone_set('Africa/Maputo');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = [];
    $campos = array('int' => $_POST['user'], 'int' => $_POST['pin']);

    /**
     * validar os campos digitados pelo usuario
     */
    foreach ($campos as $key => $value) {
        if (validarCampos($key, $value)) {
            $numero_conta = strval($_POST['user']);
            $pin = $_POST['pin'];
        }
    }
    
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
				exit();
            } else {
                // verifcar o numero de tentativas na BD
                $verificarTentativas = readOne("SELECT * FROM usuario WHERE numero_conta = :nr", [':nr' => $numero_conta]);

                if ($verificarTentativas['tentativas'] > 1) {
                    // bloquear conta do usuario mudando o estado para 0   
                    changeUserState("UPDATE usuario SET estado = 0 WHERE numero_conta = :numero", [':numero' => $numero_conta]);

                    $error[] = "O numero da conta atingiu o limite de tentativas.";
                    $error[] = "Proxima tentativa ira bloquear a conta por 3 horas.";
                    $_SESSION['error'] = $error;
                    header('Location: ../index.php');
                    die();
                }
                // incrementar as tentativas.
                changeUserState("UPDATE usuario SET tentativas = tentativas + 1 WHERE numero_conta = :id", ['id' => $numero_conta]);

                $error[] = "O numero da conta ou password devem estar incorrectos.";
                $_SESSION['error'] = $error;
                header('Location: ../index.php');
                die();
            }
        } else {
            $sql = "SELECT * FROM usuario WHERE numero_conta = :numero AND estado = :estado";
            $dados = readOne($sql, ['numero' => $numero_conta, 'estado' => 0]);
           
            if (array_key_exists('estado', $dados)) {
                if ($dados['estado'] == 0) {
                    bloquearConta($dados);
                    $error[] = "O usuario está com conta bloqueada por 3 horas.";
                    $horas = $_SESSION['bloqueio_time'];
                    $date = new DateTime("@$horas");
                    $error[] = "A conta desbloqueia daqui à: " . $date->format('H:i:s'); 
                    
                    
                    $_SESSION['error'] = $error;
                    header('Location: ../index.php');
                    die();
                }
            } else {
                $error[] = "O usuario não está cadastrado no sistema.";
                
                $_SESSION['error'] = $error;
                header('Location: ../index.php');
            }
        }
    }
}
