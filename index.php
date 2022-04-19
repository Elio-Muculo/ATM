<?php session_start(); ?>
<!doctype html>
<html lang="pt">
  <head>
  	<title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(images/bg-1.jpg);">
			      	</div>
					<div class="login-wrap p-4 p-md-5">
						<div class="d-flex">
							<div class="w-100">
								<h3 class="mb-4">BEM-VINDO, CARO CLIENTE!</h3>
							</div>
						</div>
						<form action="includes/login.inc.php" method="POST" class="signin-form">
							<?php if (isset($_SESSION['error'])) : ?>
										<?php 
										if (isset($_SESSION["error"])) :
											foreach($_SESSION['error'] as $erro) : ?>
												<div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
													<?php echo $erro; ?>
												</div>
										<?php endforeach; 
											unset($_SESSION['error']);
										endif;
								 endif; ?>
							<div class="form-group mb-3">
								<label class="label" for="name">Número da conta</label>
								<input type="number" class="form-control" name="user" placeholder="introduzir número da conta" required>
							</div>
							<div class="form-group mb-3">
								<label class="label" for="password">Código de autenticação</label>
							<input type="password" class="form-control" name="pin" placeholder="pin de 4 dígitos" required>
							</div>
							<div class="form-group">
								<button type="submit"  class="form-control btn btn-primary rounded submit px-3">Entrar</button>
							</div>

						</form>
		          		<p class="text-center">Ainda não tem uma conta: <a data-toggle="tab" href="#signup">Criar uma conta</a></p>
		       		 </div>
		      	</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

