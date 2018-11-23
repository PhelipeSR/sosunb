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
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/fontawesome/css/font-awesome.min.css')?>">
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
						<span class="badge badge-danger label-notification" id="cont_complaint"><?php if($complaint) echo count($complaint); else echo '0'?></span>
					</a>
					<ul class="app-notification dropdown-menu dropdown-menu-right">
						<li class="app-notification__title">DENÚNCIAS FEITAS.</li>
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
			<div class="app-sidebar__user mb-0">
				<figure class="figure m-0">
					<img class="img-fluid img-perfil" src="<?php echo base_url("uploads/perfil/".$this->session->user_image);?>" alt="Imagem do usuário">
					<figcaption class="app-sidebar__user-name text-center mt-1 nome-perfil"><?php echo $this->session->user_name;?></figcaption>
				</figure>
			</div>
			<ul class="app-menu">
				<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Demandas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
					<ul class="treeview-menu">
						<li><a class="treeview-item" id="ranking" href="#ranking"><i class="icon fa fa-circle-o"></i> Ranking</a></li>
						<li><a class="treeview-item" id="feed" href="#feed"><i class="icon fa fa-circle-o"></i> Feed</a></li>
						<li><a class="treeview-item" id="lista" href="#lista"><i class="icon fa fa-circle-o"></i> Lista de Demandas</a></li>
					</ul>
				</li>
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
							<div id="ajax-content">
								<div class="row">
									<div class="col-lg-4">
										<div class="widget-small coloured-icon border primary"><i class="icon fa fa-users fa-3x"></i>
											<div class="info">
												<h6>Usuários Cadastrados</h6>
												<p><b><?php print_r($info[0]) ?></b></p>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="widget-small coloured-icon border success"><i class="icon fa fa-check fa-3x"></i>
											<div class="info">
												<h6>Demandas Cadastradas</h6>
												<p><b><?php print_r($info[1]) ?></b></p>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="widget-small coloured-icon border danger"><i class="icon fa fa-ban fa-3x"></i>
											<div class="info">
												<h6>Demandas Não Solucionadas</h6>
												<p><b><?php print_r($info[2]) ?></b></p>
											</div>
										</div>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-lg-6 col-md-3">
										<canvas id="demandaCampus" ></canvas>
									</div>
									<div class="col-lg-6 col-md-3">
										<canvas id="demandaCampus1"></canvas>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col">
										<canvas id="demandaCategoria" ></canvas>
									</div>
								</div>
							</div>
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
		<script src="<?php echo base_url('assets/plugins/chart/chart.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/main.js') ?>"></script>
		<script src="<?php echo base_url('assets/plugins/validation/jquery.validate.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/plugins/datatables/datatables.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/admin/menu_admin.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/admin/admin.js') ?>"></script>
		<script>
			var ctx = $('#demandaCampus');
			var myDoughnutChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					datasets: [{
						data: [
							<?php foreach ($info[3] as $row): ?>
								'<?php echo $row['total_campus'] ?>',
							<?php endforeach ?>
						],
						backgroundColor: [
							'rgba(75, 192, 192, 0.8)',
							'rgba(255, 206, 86, 0.8)',
							'rgba(255, 99, 132, 0.8)',
							'rgba(153, 102, 255, 0.8)',
							'rgba(54, 162, 235, 0.8)',
							'rgba(255, 159, 64, 0.8)',
						],
					}],
					labels: [
						<?php foreach ($info[3] as $row): ?>
							'<?php echo $row['campus'] ?>',
						<?php endforeach ?>
					]
				},
				options: {
					title: {
						display: true,
						text: 'DEMANDAS POR CAMPUS',
					}
				}
			});

			var ctx1 = $('#demandaCategoria');
			var myChart = new Chart(ctx1, {
				type: 'bar',
				data: {
					labels: [
						<?php foreach ($info[4] as $row): ?>
							'<?php echo $row['category'] ?>',
						<?php endforeach ?>
					],
					datasets: [{
						label : 'Não Resolvidas',
						backgroundColor: 'rgba(236, 107, 86, 0.6)',
						borderColor: 'rgba(236, 107, 86, .8)',
						data: [
							<?php foreach ($info[4] as $row): ?>
								'<?php echo $row['category_aberta'] ?>',
							<?php endforeach ?>
						]
					},{
						label : 'Resolvidas',
						backgroundColor: 'rgba(97, 188, 109, 0.6)',
						borderColor: 'rgba(97, 188, 109, .8)',
						data: [
							<?php for($i = 0; $i < count($info[4]); $i++): ?>
								1,
							<?php endfor ?>
						]
					}]
				},
				options: {
					title: {
						display: true,
						text: 'DEMANDAS RESOLVIDAS E NÃO RESOLVIDAS POR CATEGORIAS',
					},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							},
							stacked: true
						}],
						xAxes: [{
							stacked: true,
						}]
					}
				}
			});
		</script>

	</body>
</html>