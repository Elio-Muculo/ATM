<?php 

include_once str_replace("\\", "/", dirname(__FILE__)). "/includes/header.php";

?>


        <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5" style="width: 100%;">
        <nav class="navbar navbar-expand-lg navbar-white bg-light rounded shadow-sm mb-4">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <p>Bem - vindo,
                            <?php echo ucfirst($dado['user'])."." ?? 'Desconhecido'; ?>
                        </p>
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


        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Relatório de Credelec</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body alert alert-info">
                <p style="color: #000;">Ref: xxxe0000</p>
                <p style="color: #000;">Contador: <?= strtoupper($_SESSION['numero']) ?? '' ?></p>
                <p style="color: #000;">valor recarga: <?= $_SESSION['valor'] . " MZN" ?? '' ?></p>
                <p style="color: #000;">Código recarga: <?= $_SESSION['recarga'] ?? '' ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <a href="/templates/credelecPdf.php">
                    <button type="button" class="btn btn-primary">Imprimir Recibo</button>
                </a>
            </div>
            </div>
        </div>
        </div>

        
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>
        
        <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
                 Caro Cliente, essa funcionalidade tem o custo de 10,00 MZN.
            </div>
        </div>
        
        
   
        <div class="row justify-content-center mt-3 ">
            <form action="includes/credelec.inc.php" method="POST" class="signin-form">
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                        <div> 
                            <?= $_SESSION["error"]; ?>
                            <?php unset($_SESSION['error']); ?>
                        </div> 
                    </div>
                <?php  endif; ?>
                <div class="form-group mb-3"  style="width: 450px;">
                   <label class="label" for="contador">Digite o codigo contador.</label>
                <input type="text" class="form-control" name="contador">
                </div>
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


<script>
        /**
         * Pegar a mensagem na url #Hash e mostrar o modal se for correspondente
         */
        if (window.location.hash == "#credelec") {
            $("#exampleModal").modal("show");
        }
</script>

</body>
</html>