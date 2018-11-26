<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html lang="pt-br">
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="<?php echo base_url('assets/images/logo.png') ?>" type="image/x-icon">
		<title>SOS UnB - Login</title>

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
				<form class="login-form p-3" id="formLogin">
					<div class="text-center">
						<img width="80px" src="<?php echo base_url('assets/images/logo.png') ;?>">
						<h1 class="h3 font-weight-normal">Iniciar Sessão</h1>
					</div>
					<div id="show_mensage"></div>

					<div class="form-group">
						<div class="input-group">
							<input type="email" name="email" class="form-control" placeholder="Email" autocomplete="username" autofocus>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="password" name="password" class="form-control" placeholder="Senha" autocomplete="current-password">
						</div>
					</div>
					<div class="form-group">
						<div class="utility">
							<div class="animated-checkbox">
							<label>
								<input type="checkbox"><span class="label-text">Lembrar-me</span>
							</label>
							</div>
							<p class="semibold-text mb-2"><a href="#" data-toggle="flip">Esqueceu Sua Senha?</a></p>
						</div>
					</div>
					<button id="btnLogin" class="btn btn-primary btn-block"><i class="fa fa-sign-in"></i> LOGIN</button>
				</form>

				<form class="forget-form p-3" id="formRecoperacao">
					<div class="text-center">
						<img width="80px" src="<?php echo base_url('assets/images/logo.png') ;?>">
						<h1 class="h3 font-weight-normal">Esqueceu Sua Senha?</h1>
					</div>
					<div id="show_mensage_recuperacao"></div>
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" type="email" name="email" placeholder="Email">
						</div>
					</div>
					<div class="form-group btn-container">
						<button id="btnResetar" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i> RESETAR</button>
					</div>
					<div class="form-group mt-3">
						<p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Voltar Para Login</a></p>
					</div>
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
		<script src="<?php echo base_url('assets/js/admin/login.js') ?>"></script>

		<script type="text/javascript">
			// Login Page Flipbox control
			$('.login-content [data-toggle="flip"]').click(function() {
			$('.login-box').toggleClass('flipped');
				return false;
			});
		</script>
	</body>
</html>