<?php 

if (isset($_SESSION['conta_negada'])) {

    //vereficar se a contagem ja terminou.
        // 1 hora = 60 min = 3600s
        // 3 horas = 180 = 10800s
    if(tempoBloqueioConta(10800) < 1) {
        $_SESSION['conta_negada'] = 0;
        session_destroy();
        header('Location: ../saldo.php');
        exit();
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

