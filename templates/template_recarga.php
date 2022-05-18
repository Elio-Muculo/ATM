<?php session_start(); 

include_once "../includes/crud.php";

$id = $_SESSION['id_user'];

$sql = "SELECT * FROM credito r INNER JOIN usuario u ON r.id_cliente = u.id WHERE r.id_cliente = :id ORDER BY r.id DESC LIMIT 1";
$dado = readAll($sql, ['id' => $id]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatorio</title>
</head>

<style>
    .line {
        margin-top: 25px;
        height: 2px;
        width: 95%;
        background-color: #4c2d45;
    }
</style>

<body>
    
<div style="display: flex;
    flex-direction: row;
        justify-content: space-around;
        align-items: center;
        width: 100%; box-shadow: 0px 0px 15px 8px rgba(186,186,186,0.85)">
    <p>A T M - ELIO MUCULO</p>
    <div>
        <p>Nome: <?= ucfirst($dado[0]['user']); ?></p>
        <p>Data de emissão: <?= date("d-m-Y H:i:s")?></p>
    </div>
</div>


<hr class="line">

<table width="100%"  style="text-align: center; padding: 30px 0;">
    <thead>
        <tr>
            <th scope="col">Recarga</th>
            <th scope="col">Operadora</th>
            <th scope="col">Valor</th>
            <th scope="col">Data</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dado as $d):?>
        <tr  style="background-color: #bababa;">
            <td ><?= $_SESSION['recarga']; ?></td>
            <td><?= ucfirst($_SESSION['operadora']); ?></td>
            <td  style="padding: 4px 0; margin: 3px 0;"><?= $_SESSION['valor']; ?></td>
            <td><?= $d['data_recarga']; ?></td>
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>

<hr class="line">


<div style="margin-top: 35px; text-align: center;">
            <p>Copyright &copy; <?= date("Y"); ?> - Todos direitos reservados <i class="icon-heart" aria-hidden="true"></i>
</div>

</body>
</html>