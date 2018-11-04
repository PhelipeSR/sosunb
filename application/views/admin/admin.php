<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="<?php echo base_url('assets/images/logo.png') ?>" type="image/x-icon">
		<title>SOS UnB - Administrador</title>

		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/datatables.css')?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/toastr/toastr.min.css')?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class="app sidebar-mini rtl">

		<header class="app-header">
			<a class="app-header__logo" href="<?php echo base_url('administrador')?>">SOS UnB</a>
			<!-- Sidebar toggle button-->
			<a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
			<!-- Navbar Right Menu-->
			<ul class="app-nav">
				<!--Notification Menu-->
				<li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
					<ul class="app-notification dropdown-menu dropdown-menu-right">
						<li class="app-notification__title">You have 4 new notifications.</li>
						<div class="app-notification__content">
							<li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
									<div>
										<p class="app-notification__message">Lisa sent you a mail</p>
										<p class="app-notification__meta">2 min ago</p>
									</div></a></li>
							<li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
									<div>
										<p class="app-notification__message">Mail server not working</p>
										<p class="app-notification__meta">5 min ago</p>
									</div></a></li>
							<li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
									<div>
										<p class="app-notification__message">Transaction complete</p>
										<p class="app-notification__meta">2 days ago</p>
									</div></a></li>
							<div class="app-notification__content">
								<li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
										<div>
											<p class="app-notification__message">Lisa sent you a mail</p>
											<p class="app-notification__meta">2 min ago</p>
										</div></a></li>
								<li>
									<a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
										<div>
											<p class="app-notification__message">Mail server not working</p>
											<p class="app-notification__meta">5 min ago</p>
										</div>
									</a>
								</li>
								<li>
									<a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
										<div>
											<p class="app-notification__message">Transaction complete</p>
											<p class="app-notification__meta">2 days ago</p>
										</div>
									</a>
								</li>
							</div>
						</div>
						<li class="app-notification__footer"><a href="#">See all notifications.</a></li>
					</ul>
				</li>
				<!-- User Menu-->
				<li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
					<ul class="dropdown-menu settings-menu dropdown-menu-right">
						<li><a class="dropdown-item" id="perfil" href="#perfil"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url('logout/')?>"><i class="fa fa-sign-out fa-lg"></i> Sair</a></li>
					</ul>
				</li>
			</ul>
		</header>

		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

		<aside class="app-sidebar">
			<div class="app-sidebar__user">
				<figure class="figure m-0">
					<img class="img-fluid img-perfil" src="http://localhost/sosunb/uploads/perfil/a81603575a318a75306db271936d30ee.png" alt="User Image">
					<figcaption class="app-sidebar__user-name text-center mt-1 nome-perfil">Phelipe Sousa Resende</figcaption>
				</figure>
			</div>
			<ul class="app-menu">
				<li><a class="app-menu__item" id="status" href="#status"><i class="app-menu__icon fa fa-toggle-on"></i><span class="app-menu__label">Status</span></a></li>
				<li><a class="app-menu__item" id="tipo-demanda" href="#tipo-demanda"><i class="app-menu__icon fa fa-tag"></i><span class="app-menu__label">Tipo de Demanda</span></a></li>
			</ul>
		</aside>

		<main class="app-content">
			<div class="row">
				<div class="col-md-12">
					<div class="tile">
						<div class="tile-body">
							<div id="loading"></div>
							<div id="ajax-content"></div>
						</div>
					</div>
				</div>
			</div>
		</main>

		<!-- JavaScript -->
		<script>function base_url(arg = ''){return '<?php echo base_url(); ?>' + arg;}</script>
		<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/main.js') ?>"></script>
		<script src="<?php echo base_url('assets/plugins/validation/jquery.validate.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/plugins/datatables/datatables.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/admin/menu_admin.js') ?>"></script>

	</body>
</html>