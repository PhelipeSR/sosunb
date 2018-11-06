<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="box">

	<h3>Perfil</h3>

	<div class="row">
		<div class="col-lg-4 col-xl-3 mb-3">
			<div class="border">
				<div class="text-center">
					<img src="<?php echo base_url('uploads/perfil/'.$dados->image_profile)?>" class="img-fluid img-perfil">
				</div>
				<div class="text-center mt-2">
					<h5 class="nome-perfil"><?php echo $dados->name;?></h5>
				</div>
				<div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
					<a class="nav-link rounded-0 active" id="v-pills-interests-tab" data-toggle="pill" href="#v-pills-interests" role="tab" aria-controls="v-pills-interests">
						<i class="fa fa-pencil-square-o"></i> Dados
					</a>
					<a class="nav-link rounded-0" id="v-pills-personal-tab" data-toggle="pill" href="#v-pills-personal" role="tab" aria-controls="v-pills-personal">
						<i class="fa fa-lock"></i> Trocar Senha
					</a>
					<a class="nav-link rounded-0" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password">
						<i class="fa fa-picture-o"></i> Imagem de Perfil</a>
					</a>
				</div>
			</div>
		</div>

		<div class="col-lg-8 col-xl-9">
			<div class="tab-content">

				<!-- Mudança de informações -->
				<div class="tab-pane fade show active" id="v-pills-interests" role="tabpanel" aria-labelledby="v-pills-interests-tab">
					<form id="formPerfil" method="post">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="name">Nome</label>
								<input type="text" class="form-control" id="name" name="name" value="<?php echo $dados->name;?>">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="email">Email</label>
								<input type="text" class="form-control" id="email" name="email" value="<?php echo $dados->email;?>">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="identity">Identidade</label>
								<input type="text" class="form-control" id="identity" name="identity" value="<?php echo $dados->identity;?>">
							</div>
							<div class="form-group col-md-4">
								<label for="registry">Matrícula</label>
								<input type="text" class="form-control" id="registry" name="registry" value="<?php echo $dados->registry;?>">
							</div>
							<div class="form-group col-md-4">
								<label for="date_birth">Data de Nascimento</label>
								<input type="date" class="form-control" id="date_birth" name="date_birth" value="<?php echo $dados->date_birth;?>">
							</div>
						</div>
						<button id="btn_dados" type="submit" class="btn btn-info">Salvar</button>
						<button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modalExcluirConta">Apagar Conta</button>
					</form>
				</div>

				<!-- Mudança de senha -->
				<div class="tab-pane fade" id="v-pills-personal" role="tabpanel" aria-labelledby="v-pills-personal-tab">
					<form id="formSenhas">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="current_password">Senha Atual</label>
								<input type="password" class="form-control" id="current_password" name="current_password" autocomplete="current-password">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="new_password">Nova Senha</label>
								<input type="password" class="form-control" id="new_password" name="new_password" autocomplete="new-password">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="confirm_password">Confirmar Nova Senha</label>
								<input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="new-password">
							</div>
						</div>
						<button id="btn_senhas" type="submit" class="btn btn-info">Salvar</button>
					</form>
				</div>

				<!-- Mudança de imagem de perfil -->
				<div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
					<form id="formImage">
						<div class="form-row">
							<div class="form-group col">
								<label for="image_profile">Escolher Imagem</label>
								<input type="file" id="image_profile" class="form-control form-control-file" name="image_profile" accept="image/*">
							</div>
						</div>
						<button id="btn_image" type="submit" class="btn btn-info">Salvar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal excluir conta -->
	<div class="modal fade" id="modalExcluirConta" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tem certeza que deseja excluir sua conta?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formExcluirConta">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="password_excluir">Digite sua senha para excluir</label>
								<input type="password" class="form-control" id="password_excluir" name="password" autocomplete="current-password">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button id="btn_excluir" type="submit" class="btn btn-danger">Excluir</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div> <!-- /.box -->