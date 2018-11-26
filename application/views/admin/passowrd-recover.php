<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html lang="pt-br">
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="<?php echo base_url('assets/images/logo.png') ?>" type="image/x-icon">
		<title>SOS UnB - Recuperar Senha</title>

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
				<form class="login-form p-3" id="formRecuperar">
					<div class="text-center">
						<img width="80px" src="<?php echo base_url('assets/images/logo.png') ;?>">
						<h1 class="h3 font-weight-normal">Recuperar Senha</h1>
					</div>

					<div id="show_mensage"></div>
					<div class="form-group">
						<div class="input-group">
							<input type="password" id="password" name="password" class="form-control" placeholder="Nova Senha" autocomplete="current-password">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="password" name="confPassword" class="form-control" placeholder="Confirmar Senha" autocomplete="current-password">
						</div>
					</div>
					<input type="hidden" name="token" value="<?php echo $token;?>">
					<button id="btnRecuperar" class="btn btn-primary btn-block"><i class="fa fa-sign-in"></i> RECUPERAR</button>
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
		<script src="<?php echo base_url('assets/js/admin/recuperar.js') ?>"></script>

		<script type="text/javascript">
			// Login Page Flipbox control
			$('.login-content [data-toggle="flip"]').click(function() {
			$('.login-box').toggleClass('flipped');
				return false;
			});
		</script>
	</body>
</html>