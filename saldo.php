<?php 

include_once str_replace("\\", "/", dirname(__FILE__)). "/includes/header.php";






?>
<!-- Page Content  -->
    <div id="content" class="p-4 p-md-5" style="width: 100%">
        <nav class="navbar navbar-expand-lg navbar-white bg-light rounded shadow-sm mb-4">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <p>Bem - vindo, <?php
                        echo ucfirst($dado['user'])."." ?? 'Desconhecido'; ?></p>
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
    
        <?php if (isset($_SESSION['sucess'])) : ?>
            <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    <?php echo $_SESSION["sucess"] ?? ''; ?>
                    <?php unset($_SESSION['sucess']); ?>
                </div>
            </div>
       <?php  endif; ?>
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
                        <h5 class="card-title">MZN <?php echo $saldo['saldo'].",00"; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>