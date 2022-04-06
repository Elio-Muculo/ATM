<?php 
session_start();

if (!isset($_SESSION['saldo']) || $_SESSION['saldo'] <= 10) {
    $_SESSION['saldo'] = 1000;
}

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
    <title>Saldo</title>
</head>
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
	        </ul>

	        <div class="footer">
                <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos direitos reservados <i class="icon-heart" aria-hidden="true"></i>
            </div>
	</div>
    </nav>

        <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5" style="width: 100%">
        <nav class="navbar navbar-expand-lg navbar-white bg-light rounded shadow-sm mb-4">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <p>Bem - vindo Caro Cliente #nome_do_usuario</p>
                    </ul>
                </div>
            </div>
        </nav>

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page" style="color: #4c2d45;">consulta saldo</li>
            </ol>
        </nav>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card text-dark bg-light mb-3" style="max-width: 18rem; visibility: hidden;">
                    <div class="card-header">Saldo Actual</div>
                    <div class="card-body">
                      <h3 class="card-title">MZN</h3>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card text-dark bg-light mb-3" style="max-width: 18rem; visibility: hidden;">
                    <div class="card-header"></div>
                    <div class="card-body">
                      <h5 class="card-title">Light card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-4">
                <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Saldo Actual</div>
                    <div class="card-body">
                        <h5 class="card-title">MZN <?php echo (isset($_SESSION['saldo'])) ? $_SESSION['saldo'].",00" : "0,00"; ?></h5>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>


</body>
</html>