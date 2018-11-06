<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html lang="pt-br">
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="<?php echo base_url('assets/images/logo.png') ?>" type="image/x-icon">
		<title>SOS UnB - Login</title>

		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/imagehover.css') ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	</head>
	<body>
		<?php $this->load->view('site/navbar')?>

		<!-- Carousel -->
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="carousel-item active img-carousel-1">
					<div class="d-flex h-100 align-items-center justify-content-center">
						<div class="carousel-caption">
							<h1>Ajude a melhorar nossa universidade!</h1>
							<p class="lead">BAIXE NOSSO APP</p>
							<div>
								<a href="https://itunes.apple.com/br/app/apple-store/id375380948?mt=8" target="_blank">
									<img src="<?php echo base_url('assets/images/app-store.png')?>" class="img-loja mb-1">
								</a>
								<a href="https://play.google.com/store/apps?hl=br" target="_blank">
									<img src="<?php echo base_url('assets/images/play-store.png')?>" class="img-loja mb-1">
								</a>
							</div>
							<div class="">
								<img class="img-fluid img-celular" src="<?php echo base_url('assets/images/celular.png')?>">
								<!-- <img src="<?php echo base_url('assets/images/celular2.png')?>" style="width:26%;"> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Quem somos -->
		<section id="quem-somos" class="py-5">
			<div class="container">
				<div class="text-center">
					<h2 class="text-primary mb-3 poppins">Quem Somos</h2>
					<p class="lead px-0 mx-0 px-md-5 mx-md-5">O SOSUnB é um sistema colaborativo utilizado para reportar e ranquear
						demandas de infraestrutura na Universidade de Brasília – UnB. Seu principal objetivo é
						dar visibilidade aos problemas estruturais da UnB para a comunidade acadêmica,
						facilitando a formalização de reclamações e sugestões
						referentes à infraestrutura da universidade.
					</p>
					<hr class="border border-primary w-5 mx-auto mt-5 mb-0">
				</div>
			</div>
		</section>

		<!-- Como Funciona -->
		<section id="como-funciona" class="py-5 bg-light">
			<div class="container">
				<h2 class="text-primary text-center mb-3 poppins">Como Funciona</h2>
				<p class="lead text-center px-0 mx-0 px-md-5 mx-md-5">
					A plataforma WEB permite que qualquer cidadão possa visualizar as principais demandas já solucionadas.
					Você que é aluno, professor ou servidor da UnB, após cadastramento, poderá interagir com o SOSUnB,
					seja pela plataforma WEB ou pelo aplicativo. Após login no sistema será possível apresentar sugestões ou reclamações e visualizar todas as demandas e sugestões formuladas.
				</p>
				<hr class="border border-primary w-5 mx-auto my-5">
				<div class="row">
					<div class="col-md-4 mb-3 mb-md-0">
						<div class="media d-flex align-items-center">
							<div class="mr-3">
								<i class="fa fa-download fa-4x text-black-50"></i>
							</div>
							<div class="media-body">
								<h4>Baixe o App</h4>
								<p>Para sua maior comodidade, baixe o aplicativo SOSUnB no seu celular ou tablet. </p>
							</div>
						</div>
					</div>
					<div class="col-md-4 mb-3 mb-md-0">
						<div class="media d-flex align-items-center">
							<div class="mr-3">
								<i class="fa fa-edit fa-4x text-black-50"></i>
							</div>
							<div class="media-body">
								<h4>Crie sua demanda</h4>
								<p>Tire uma foto do problema identificado, faça sua descrição e publique sua demanda.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 mb-3 mb-md-0">
						<div class="media d-flex align-items-center">
							<div class="mr-3">
								<i class="fa fa-search fa-4x text-black-50"></i>
							</div>
							<div class="media-body">
								<h4>Acompanhe</h4>
								<p>Acompanhe sua publicação e de outros usuários. Curta quantas publicações quiser.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Solucionados -->
		<section id="solucionados" class="py-5">
			<div class="container">
				<div class="text-center">
					<h2 class="text-primary mb-3 poppins">SOSUnB em Ação!</h2>
					<p class="lead">Veja os problemas de infraestrutura que a SOSUnB já ajudou a resolver!</p>
					<hr class="border border-primary w-5 mx-auto my-5">
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<figure class="imghvr-fold-up">
							<img src="<?php echo base_url('assets/images/solucionados/anf.jpg')?>" class="img-fluid">
							<figcaption>
								<h3>Mesas e cadeiras quebradas</h3>
								<p>As mesas e cadeiras do Anf 0 foram consertadas.</p>
							</figcaption>
						</figure>
					</div>
					<div class="col-md-4 col-sm-6">
						<figure class="imghvr-fold-up">
							<img src="<?php echo base_url('assets/images/solucionados/AC.jpg')?>" class="img-fluid">
							<figcaption>
								<h3>Tomada na sala de aula</h3>
								<p>A tomada foi recolocada e agora o ar condicionado está ligado nela.</p>
							</figcaption>
						</figure>
					</div>
					<div class="col-md-4 col-sm-6">
						<figure class="imghvr-fold-up">
							<img src="<?php echo base_url('assets/images/solucionados/janela.jpg')?>" class="img-fluid">
							<figcaption>
								<h3>Janela quebrada</h3>
								<p>A janela do laboratório foi trocada.</p>
							</figcaption>
						</figure>
					</div>
					<div class="col-md-4 col-sm-6">
						<figure class="imghvr-fold-up">
							<img src="<?php echo base_url('assets/images/solucionados/poste.jpeg')?>" class="img-fluid">
							<figcaption>
								<h3>Poste com fio desencapado</h3>
								<p>O poste foi arrumado. Não existem mais fios desencapados que possam causar um choque elétrico.</p>
							</figcaption>
						</figure>
					</div>
					<div class="col-md-4 col-sm-6">
						<figure class="imghvr-fold-up">
							<img src="<?php echo base_url('')?>assets/images/solucionados/pc.jpg" class="img-fluid">
							<figcaption>
								<h3>Computador quebrado</h3>
								<p>Todos os computadores do laboratório de redes foram trocados por modelos atuais e de melhor qualidade.</p>
							</figcaption>
						</figure>
					</div>
					<div class="col-md-4 col-sm-6">
						<figure class="imghvr-fold-up">
							<img src="<?php echo base_url('')?>assets/images/solucionados/porta.jpg" class="img-fluid">
							<figcaption>
								<h3>Porta do banheiro quebrada</h3>
								<p>A porta do banheiro do SG, que havia sido danificada, foi trocada.</p>
							</figcaption>
						</figure>
					</div>
				</div>
			</div>
		</section>

		<!-- Footer -->
		<footer class="bg-primary py-5">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-md-4 mb-4 mb-md-0">
						<h5 class="text-white">Termos de uso</h5>
						<a href="#"	data-toggle="modal" data-target="#termosModal">
							<span class="text-white"><i class="fa fa-file fa-3x"></i></span>
						</a>
					</div>
					<div class="col-md-4 mb-4 mb-md-0">
						<h5 class="text-white">Baixe o Aplicativo</h5>
						<a href="https://itunes.apple.com/br/app/apple-store/id375380948?mt=8" target="_blank" class="mr-3" title="App IOS">
							<span class="text-white"><i class="fa fa-apple fa-3x"></i></span>
						</a>
						<a href="https://play.google.com/store/apps?hl=br" target="_blank" title="App Android">
							<span class="text-white"><i class="fa fa-android fa-3x"></i></span>
						</a>
					</div>
					<div class="col-md-4 mb-4 mb-md-0">
						<h5 class="text-white">Universidade de Brasília</h5>
						<a href="http://unb.br/" target="_blank" title="UnB" class="mr-3">
							<img src="<?php echo base_url('assets/images/logo-unb.png')?>" width="40" height="40">
						</a>
						<a href="http://www.ene.unb.br/" target="_blank" title="Faculdade de Tecnologia">
							<img src="<?php echo base_url('assets/images/logo-ft.jpg')?>" width="40">
						</a>
					</div>
				</div>
			</div>
		</footer>


		<!-- Modal Login-->
		<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Iniciar Sessão</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="formLogin">
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
							<p class="semibold-text mb-2 float-left"><a href="#" data-toggle="flip">Esqueceu Sua Senha?</a></p>
							<button id="btnLogin" class="btn btn-primary float-right"><i class="fa fa-sign-in"></i> LOGIN</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Cadastro-->
		<div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Cadastrar</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="formCadastro">
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
				</div>
			</div>
		</div>

		<!-- Modal Termos de uso-->
		<div class="modal fade" id="termosModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Termos de Uso</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Aqui vai os termos de uso
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
		<script src="<?php echo base_url('assets/js/admin/login.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/admin/cadastro.js') ?>"></script>
	</body>
</html>