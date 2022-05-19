<?php 

function bloquearConta($dados) {
    if (array_key_exists('estado', $dados)) {
        if ($dados['estado'] == 0) {
            //vereficar se a contagem ja terminou.
            // 1 hora = 60 min = 3600s
            // 3 horas = 180 = 10800s
            if (!isset($tempo_bloqueio)) {
                $tempo_bloqueio = tempoBloqueioConta(20);
            }

            if($tempo_bloqueio < 1) {
                changeUserState("UPDATE usuario SET estado = 1, tentativas = 0 WHERE id = :id", ['id' => $dados['id']]); 
                session_destroy();
                setcookie("msg", "A conta do usuario foi desbloqueada", time() + 3, "/");
                header('Location: ../index.php');
                exit();
            }
        }
    }
}


// @tempo - o tempo que a conta estara bloqueada em segundos
// retorna o tempo em segundos que falta para desbloquear a conta
function tempoBloqueioConta($tempo) {
    if(!isset($_SESSION['countdown'])){
        
        $_SESSION['countdown'] = $tempo;
        $_SESSION['time_started'] = time();
    }

    $now = time();


    $timeSince = $now - $_SESSION['time_started'];

    $remainingSeconds = $_SESSION['countdown'] - $timeSince;

    return $remainingSeconds;
}

