<?php 
include_once str_replace("\\", "/", dirname(__FILE__)). "/includes/header.php";
include_once str_replace("\\", "/", dirname(__FILE__)). "/includes/crud.php";


$sql = "SELECT * FROM movimento WHERE id_cliente = :id ORDER BY data_movimento DESC LIMIT 5 ";
$dados = readAll($sql, [':id' => $_SESSION['id_user']]);
?>





<!-- Page Content  -->
<div id="content" class="p-4 p-md-5" style="width: 100%;">
        <nav class="navbar navbar-expand-lg navbar-white bg-light rounded shadow-sm mb-4">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <p>Bem - vindo, <?php 
                            echo ucfirst($dado['user'])."." ?? 'Desconhecido'; ?>
                        </p>
                    </ul>
                </div>
            </div>
        </nav>

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page" style="color: #4c2d45;">Movimento</li>
            </ol>
        </nav>
        
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>
        
        <section class="rc-section mt-4">
            <div class="container">
                <div class="d-grid gap-2 d-md-block">
                    <input type="text" class="ml-3">
                    <input type="text" class="ml-3">
                    <input type="text" class="ml-3">
                    <button class="btn btn-primary ml-5" type="button">Filtrar</button>
                </div>

                <table class="table table-striped mt-5 pt-4">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Movimento</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $d):?>
                        <tr>
                            <td><?php echo $d['id']; ?></td>
                            <td><?php echo $d['tipo_operacao']; ?></td>
                            <td><?php echo $d['valor']; ?></td>
                            <td><?php echo $d['data_movimento']; ?></td>
                        </tr>
                       
                        <?php endforeach; ?>
                        <tr class="align-right">
                            <td><a href="/templates/gerarPdf.php"><button class="btn btn-primary">Baixar Factura</button></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
	    </section>        
    </div>
</div>


</body>
</html>