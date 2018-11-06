<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary py-0">
	<a class="navbar-brand" href="<?php echo base_url()?>">
		<img src="<?php echo base_url('assets/images/logo.png')?>" width="50" class="d-inline-block mr-2">
		<span class="poppins">SOS UnB</span>
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item active">
				<a class="nav-link" href="#quem-somos">Quem Somos</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="#como-funciona">Como Funciona</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="#solucionados">Solucionados</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="#" data-toggle="modal" data-target="#cadastroModal">Cadastro</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
			</li>
		</ul>
	</div>
</nav>