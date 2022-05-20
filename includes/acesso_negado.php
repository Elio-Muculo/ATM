<?php 
require_once __DIR__ . '/helper.php';

/**
 * bloqueia uma conta quando o seu estado é 0 por 3 horas
 * 
 * @param mixed $dados 
 * dados do usuario com conta a ser bloqueada.
 */
function bloquearConta($dados) {
    if (array_key_exists('estado', $dados)) {
        if ($dados['estado'] == 0) {
            //vereficar se a contagem ja terminou.
            // 1 hora = 60 min = 3600s
            // 3 horas = 180 = 10800s
            if (!isset($tempo_bloqueio)) {
                $tempo_bloqueio = tempoBloqueioConta(10800);
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


