<?php 

session_start();

include_once str_replace("\\", "/", dirname(__FILE__)). "/crud.php";

if (!isset($_SESSION['logado'])) {
    header('Location: index.php');
    die();
}

$id = $_SESSION['id_user'];

$dado = readOne("SELECT * FROM usuario WHERE id = :id", ['id' => $id]);

$sql = "SELECT * FROM saldo WHERE id_cliente = :id";
$saldo = saldo($sql, [':id' => $id]);
$_SESSION['saldo'] = $saldo['saldo'];
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo ucfirst(str_replace("/", "", basename($_SERVER['PHP_SELF'], ".php"))); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</head>

<script>
    

</script>

<body>
<div class="wrapper d-flex align-items-stretch" style="width: 100%">
<nav id="sidebar">
    <div class="p-4 pt-3">
        <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/logo.jpg);"></a>
        <ul class="list-unstyled components mb-5">
            <li>
                <a href="saldo.php">Saldo</a>
            </li>
            <li>
                <a href="levantamento.php">Levantamento</a>
            </li>
            <li>
                <a href="movimento.php">Movimentos</a>
            </li>
            <li>
                <a href="recarga.php">Recargas</a>
            </li>
            <li>
                <a href="credelec.php">Credelec</a>
            </li>
            <li>
                <a href="includes/sair.php">Sair</a>
            </li>
        </ul>

        <div class="footer pt-4">
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos direitos reservados <i class="icon-heart" aria-hidden="true"></i>
        </div>
</div>
</nav>

        