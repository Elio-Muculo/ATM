<?php session_start();

include_once str_replace("\\", "/", dirname(__FILE__)). "/includes/header.php";

?>


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
              <li class="breadcrumb-item active" aria-current="page" style="color: #4c2d45;">Credelec</li>
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
        

        <?php if (isset($_COOKIE['recarga'])) { ?>
            <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    &nbsp;&nbsp;&nbsp; Caro Cliente, o codigo da sua recarga é: 
                    <?php echo isset($_COOKIE["recarga"]) ? $_COOKIE["recarga"] : ''; ?>
                    <?php  setcookie('recarga', null, -1, '/'); ?>
                </div> 
            </div>
       <?php  } ?>
        
   
        <div class="row justify-content-center mt-3 ">
            <form action="includes/credelec.inc.php" method="POST" class="signin-form">
                <div class="form-group mb-3"  style="width: 450px;">
                   <label class="label" for="contador">Digite o codigo contador.</label>
                <input type="number" class="form-control" name="contador">
                </div>
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                        <div> 
                            <?php echo isset($_SESSION["error"]) ? $_SESSION["error"] : ''; ?>
                            <?php  unset($_SESSION['error']); ?>
                        </div> 
                    </div>
                <?php  } ?>
                <div class="form-group mb-3">
                   <label class="label" for="valor">Digite o valor do credelec.</label>
                <input type="number" class="form-control" name="valor">
                </div>
                <div class="form-group">
                    <button type="submit"  class="form-control btn btn-primary rounded submit px-3">Comprar</button>
                </div>
            </form>
        </div>
        
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>