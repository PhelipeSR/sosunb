<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html lang="pt-br">
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="<?php echo base_url('assets/images/logo.png') ?>" type="image/x-icon">
		<title>SOS UnB - Cadastro</title>

		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	</head>
	<body>
		<?php $this->load->view('site/navbar')?>
		<section class="material-half-bg">
			<div class="cover bg-white"></div>
		</section>
		<section class="login-content mt-5">
			<div class="login-box">
				<form class="login-form p-3" id="formCadastro">
					<div class="text-center">
						<img width="80px" src="<?php echo base_url('assets/images/logo.png') ;?>">
						<h1 class="h3 font-weight-normal">Cadastrar</h1>
					</div>

					<div id="show_mensage"></div>
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="name" class="form-control" placeholder="Nome Completo" autofocus>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="email" name="email" class="form-control" placeholder="Email" autocomplete="username">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="registry" class="form-control" placeholder="Matrícula">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="identity" class="form-control" placeholder="Identidade">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="date" name="date_birth" class="form-control" placeholder="Data de Nascimento">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="password" name="password" class="form-control" id="password" placeholder="Senha" autocomplete="new-password">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="password" name="conf_password" class="form-control" placeholder="Confirmar Senha" autocomplete="new-password">
						</div>
					</div>
					<button id="btnCadastro" class="btn btn-primary btn-block"><i class="fa fa-user-plus"></i> CADASTRAR</button>
				</form>
			</div>
		</section>

		<!-- JavaScript -->
		<script>function base_url(arg = ''){return '<?php echo base_url(); ?>' + arg;}</script>
		<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/plugins/validation/jquery.validate.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/main.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/admin/cadastro.js') ?>"></script>
	</body>
</html>