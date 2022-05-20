<?php 
session_start();
require_once 'crud.php';
require_once 'validator.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = [];

    $campos = array('string' => $_POST['user'], 'int' => $_POST['pin'], 'int' => $_POST['cpin']);

    /**
     * validar os campos digitados pelo usuario
     */
    foreach ($campos as $key => $value) {
        if (validarCampos($key, $value)) {
            $nome = strval($_POST['user']);
            $pin = $_POST['pin'];
            $cpin = $_POST['cpin'];
            $numero_conta = numeroConta(7);
        }
    }

    if ($pin !== $cpin) {
        $error[] = "<p>Os pin não são compatíveis</p>";
        $_SESSION['error'] = $error;
        header('Location: ../Registrar.php');
        die();
    } else {
        $pin = password_hash($pin, PASSWORD_DEFAULT);
        $dados = ['numero' => $numero_conta, 'user' => $nome, 'senha' => $pin, 'estado' => 1, 'datalogin' => date("Y-m-d H:i:s")];
        $sql = "INSERT INTO usuario (numero_conta, user, senha, estado, data_login) VALUES (:numero, :user, :senha, :estado, :datalogin)";
        $inserted = insertAll($sql, $dados);

        if ($inserted == 1) {
            $id = readOne("SELECT id FROM usuario ORDER BY id DESC LIMIT 1");

            insertAll("INSERT INTO saldo (saldo, id_cliente) VALUES (10000, :id)", [':id' => $id['id']]);
            $_SESSION['conta'] = $numero_conta;
            header('Location: ../index.php#signUp');
            die();
        } else {
            $error[] = "<p>Os dados não foram inseridos</p>";
            $_SESSION['error'] = $error;
            header('Location: ../Registrar.php');
            die();
        }
    }
    
}

/**
 * * gerar codigo de 16 numeros de credelec.
 * 
 * @param int $lenght
 * tamanho do numero da conta a ser gerado
 * 
 * @return int 
 * retorna o numero da conta aleotorio com tamanho $lenght. 
 * 
 */
function numeroConta($lenght) {
    $char = "1234567890";
    $charLenght = strlen($char);
    $codigo = '';
    for ($i = 0; $i < $lenght; $i++) {
        $codigo .= $char[random_int(0, $charLenght - 1)];
    }
    return intval($codigo);
}
