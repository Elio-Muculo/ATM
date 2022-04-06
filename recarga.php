<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Recargas</title>
</head>
<body>

    
<div class="wrapper d-flex align-items-stretch">
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
    <div id="content" class="p-4 p-md-5" style="width: 100%;">
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
              <li class="breadcrumb-item active" aria-current="page" style="color: #4c2d45;">Recarga</li>
            </ol>
        </nav>
        
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>
        
        <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
                &nbsp;&nbsp;&nbsp; Caro Cliente, essa funcionalidade tem o custo de 10,00 MZN.
            </div>
        </div>
        
        <div class="row justify-content-center mt-5 pt-4">
            <form action="includes/levantamento.inc.php" method="POST" class="">
                <div class="form-group mb-3">
                   <label class="label" for="password">Digite o valor deseja levantar.</label>
                <input type="number" class="form-control" name="valor"  required>
                </div>
                <div class="form-group">
                    <button type="submit"  class="form-control btn btn-primary rounded submit px-3">Levantar</button>
                </div>
            </form>
        </div>
        
    </div>
</div>


</body>
</html>