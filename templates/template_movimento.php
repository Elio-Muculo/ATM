<?php session_start(); 

include_once "../includes/crud.php";

$id = $_SESSION['id_user'];

$sql = "SELECT * FROM movimento m INNER JOIN usuario u ON m.id_cliente = u.id WHERE m.id_cliente = :id";

$dado = readOne($sql, ['id' => $id]);


$sql = "SELECT * FROM movimento WHERE id_cliente = :id ORDER BY data_movimento DESC LIMIT 8 ";
$dados = readAll($sql, [':id' => $_SESSION['id_user']]);


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
        margin-top: 15px;
        height: 2px;
        width: 90%;
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
        <p>Nome: <?= ucfirst($dado['user']); ?></p>
        <p>Data de emissão: <?= date("d-m-Y H:i:s")?></p>
        <p>N.º da conta#: <?= $dado['numero_conta']?></p>
    </div>
</div>


<hr class="line">

<table width="100%"  style="text-align: center; padding: 30px 0;">
    <thead>
        <tr>
            <th scope="col"  style="padding: 6px 0;">#</th>
            <th scope="col">Movimento</th>
            <th scope="col">Valor</th>
            <th scope="col">Data</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados as $d):?>
        <tr  style="background-color: #bababa;">
            <td  style="padding: 6px 0; margin: 3px 0;"><?php echo $d['id']; ?></td>
            <td ><?php echo $d['tipo_operacao']; ?></td>
            <td><?php echo $d['valor']. ".00 MZN"; ?></td>
            <td><?php echo $d['data_movimento']; ?></td>
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>

<hr class="line">


<div style="margin-top: 55px; text-align: center;">
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos direitos reservados <i class="icon-heart" aria-hidden="true"></i>
</div>

</body>
</html>