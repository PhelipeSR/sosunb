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
				<li class="dropdown">
					<a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
						<i class="fa fa-bell-o fa-lg"></i>
						<span class="badge badge-danger label-notification" id="cont_complaint"><?php if($complaint) echo count($complaint)?></span>
					</a>
					<ul class="app-notification dropdown-menu dropdown-menu-right">
						<li class="app-notification__title">DENÚNCIAS FEITAS.</li>
						<div class="app-notification__content">
							<?php if($complaint): ?>
								<?php foreach ($complaint as $row): ?>
									<li id="complaint_content_<?php echo $row->id?>">
										<a class="app-notification__item px-1 demands-complaint" href="javascript:;" data-id-demands="<?php echo $row->id?>">
											<div class="row align-items-center">
												<div class="col-3 pr-0">
													<img class="img-fluid" src="<?php echo base_url("uploads/demandas/".$row->image);?>" alt="User Image">
												</div>
												<div class="col-9">
													<p class="app-notification__message"><?php echo $row->title?></p>
													<p class="app-notification__meta"><?php echo $row->counter?> Reclamações feitas</p>
												</div>
											</div>
										</a>
									</li>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
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
					<img class="img-fluid img-perfil" src="<?php echo base_url("uploads/perfil/".$this->session->user_image);?>" alt="Imagem do usuário">
					<figcaption class="app-sidebar__user-name text-center mt-1 nome-perfil"><?php echo $this->session->user_name;?></figcaption>
				</figure>
			</div>
			<ul class="app-menu">
				<li><a class="app-menu__item" id="usuarios" href="#usuarios"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Usuários</span></a></li>
				<li><a class="app-menu__item" id="status" href="#status"><i class="app-menu__icon fa fa-toggle-on"></i><span class="app-menu__label">Status</span></a></li>
				<li><a class="app-menu__item" id="tipo-demanda" href="#tipo-demanda"><i class="app-menu__icon fa fa-tag"></i><span class="app-menu__label">Tipo de Demanda</span></a></li>
				<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-map-marker"></i><span class="app-menu__label">Local</span><i class="treeview-indicator fa fa-angle-right"></i></a>
					<ul class="treeview-menu">
						<li><a class="treeview-item" id="local" href="#local"><i class="icon fa fa-circle-o"></i> Local</a></li>
						<li><a class="treeview-item" id="ambiente" href="#ambiente"><i class="icon fa fa-circle-o"></i> Ambiente</a></li>
						<li><a class="treeview-item" id="campus" href="#campus"><i class="icon fa fa-circle-o"></i> Campus</a></li>
						<li><a class="treeview-item" id="area" href="#area"><i class="icon fa fa-circle-o"></i> Área</a></li>
					</ul>
				</li>
				<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-exclamation-triangle"></i><span class="app-menu__label">Tipo de Problema</span><i class="treeview-indicator fa fa-angle-right"></i></a>
					<ul class="treeview-menu">
						<li><a class="treeview-item" id="tipo-problema" href="#tipo-problema"><i class="icon fa fa-circle-o"></i> Tipo de Problema</a></li>
						<li><a class="treeview-item" id="categoria" href="#categoria"><i class="icon fa fa-circle-o"></i> Categoria</a></li>
					</ul>
				</li>
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

		<!-- Modal Avaliar Denúncia-->
		<div class="modal fade" id="denunciaModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Avaliar Denúncia</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="modal_body_denuncia">
						<div id="conteudo_denuncia"></div>
					</div>
				</div>
			</div>
		</div>

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
		<script src="<?php echo base_url('assets/js/admin/admin.js') ?>"></script>

	</body>
</html>