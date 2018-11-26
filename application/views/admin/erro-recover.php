<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html lang="pt-br">
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="<?php echo base_url('assets/images/logo.png') ?>" type="image/x-icon">
		<title>SOS UnB - Erro de Recuperação de Senha</title>

		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/fontawesome/css/font-awesome.min.css')?>">

	</head>
	<body>
		<section class="material-half-bg">
			<div class="cover"></div>
		</section>
		<section class="login-content">
			<div class="login-box">
				<div class="row p-3 text-center">
					<div class="col">
						<h2><i class="fa fa-frown-o" aria-hidden="true"></i> Algo deu Errado</h2>
						<p class="lead">Infelizmente não conseguimos fazer a recuperação da sua conta.<br> Tente enviar uma nova requisição pelo aplicativo</p>
					</div>
				</div>
			</div>
		</section>

		<!-- JavaScript -->
		<script>function base_url(arg = ''){return '<?php echo base_url(); ?>' + arg;}</script>
		<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/main.js') ?>"></script>
	</body>
</html>