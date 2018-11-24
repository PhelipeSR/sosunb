<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="box">

	<h3 class="box-title">Ranking</h3>
	<div class="row justify-content-center">
		<div class="col-lg-8 col-xl-6 border py-3 shadow-sm">
			<div class="media d-flex align-items-center">
				<img class="img-fluid mr-3" style="max-width: 50px" src="<?php echo base_url('uploads/perfil/default.png')?>">
				<div class="media-body">
					<span class="text-primary">Phelipe Sousa Resende</span>
					<span class="text-muted">publicou</span>
					<span class="font-weight-bold">Lampada estragada</span>
					<span class="text-muted">em</span>
					<span class="text-muted"><i class="mx-1 fa fa-map-marker text-primary"></i>Centro Brasileiro de Serviços e Pesquisas em Proteínas (CBSP)</span>
				</div>
				<span class="float-right">
					<div class="dropdown dropleft">
						<button class="btn btn-link pr-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="#">Denunciar Demanda</a>
						</div>
					</div>
				</span>
			</div>
			<div class="mt-3">
				<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit eos fugit quisquam magni eum deleniti dolorum ea voluptates reiciendis delectus, vitae illo cupiditate vero dolor laudantium nihil doloribus et saepe.</p>
			</div>
			<div class="w-100 text-center mt-3" style="height: 300px">
				<img class="img-fluid" style="height:100%;object-fit:cover;" src="<?php echo base_url('uploads/demandas/default.jpg')?>" alt="">
			</div>
			<div class="clearfix my-2 text-primary">
				<p class="m-0 float-lg-left"><span><i class="fa fa-thumbs-up"></i></span> 6 </p>
				<a href="#" class="m-0 float-right">2 Comentarios</a>
			</div>
			<div class="border-top border-bottom">
				<div class="row">
					<div class="col pr-0">
						<div class="text-muted text-center py-2 actions">
							<h5 class="m-0"><span><i class="fa fa-thumbs-up"></i></span> Curtir</h5>
						</div>
					</div>
					<div class="col pl-0">
						<div class="text-muted text-center py-2 actions">
							<h5 class="m-0"><span><i class="fa fa-comments-o"></i></span> Comentar</h5>
						</div>
					</div>
				</div>
			</div>
			<div class="media d-flex align-items-center mt-2 bg-light radius-50 ">
				<img class="img-fluid mr-3 radius-50" style="max-width: 50px" src="<?php echo base_url('uploads/perfil/default.png')?>">
				<div class="media-body">
					<span class="text-primary">Phelipe Sousa Resende</span>
					<p class="text-muted">publicou</p>
				</div>
				<span class="float-right">
					<a class="dropdown-item" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
				</span>
			</div>
			<div class="mt-2 inputWithIcon">
				<input class="form-control comment-demand-input" type="text" name="search" placeholder="Escreva seu comentário">
				<a class="pointer" style="text-decoration: none;" href="#"><i class="fa fa-mail-forward"></i></a>
			</div>
		</div>
	</div>

</div> <!-- /.box -->