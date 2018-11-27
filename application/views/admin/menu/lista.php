<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="box">

	<h3 class="box-title">Demandas</h3>

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ativos</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Excluidos</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
			<table id="lista_table" class="table table-bordered table-striped" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Imagem</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Matrícula</th>
						<th>Identidade</th>
						<th>Nascimento</th>
						<th>Registro</th>
						<th>Tipo</th>
						<th>Operações</th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
			<table id="lista_table_exclude" class="table table-bordered table-striped" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Imagem</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Matrícula</th>
						<th>Identidade</th>
						<th>Nascimento</th>
						<th>Registro</th>
						<th>Tipo</th>
						<th>Excluido</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>

<!-- *********************************************************************************************************************** -->

	<!-- Modal Editar-->
	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar Usuário</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formEditUser" method="post">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="name_edit">Nome</label>
								<input type="text" class="form-control" id="name_edit" name="name">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="email_edit">Email</label>
								<input type="text" class="form-control" id="email_edit" name="email">
							</div>
							<div class="form-group col-md-4">
								<label for="profile_type_edit">Tipo de Usuário</label>
								<select id="profile_type_edit" class="form-control" name="profile_type">
									<option value=""></option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="identity_edit">Identidade</label>
								<input type="text" class="form-control" id="identity_edit" name="identity">
							</div>
							<div class="form-group col-md-4">
								<label for="registry_edit">Matrícula</label>
								<input type="text" class="form-control" id="registry_edit" name="registry">
							</div>
							<div class="form-group col-md-4">
								<label for="date_birth_edit">Data de Nascimento</label>
								<input type="date" class="form-control" id="date_birth_edit" name="date_birth">
							</div>
						</div>
						<input type="hidden" name="id" id="id">
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button id="btn_edit" type="submit" class="btn btn-primary">Salvar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- *********************************************************************************************************************** -->

<!-- *********************************************************************************************************************** -->
	<!-- Modal Adicionar-->
	<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Adicionar Usuário</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formAddUser" method="post">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="name_add">Nome</label>
								<input type="text" class="form-control" id="name_add" name="name">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="email_add">Email</label>
								<input type="text" class="form-control" id="email_add" name="email">
							</div>
							<div class="form-group col-md-4">
								<label for="profile_type_add">Tipo de Usuário</label>
								<select id="profile_type_add" class="form-control" name="profile_type">
									<option value=""></option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="identity_add">Identidade</label>
								<input type="text" class="form-control" id="identity_add" name="identity">
							</div>
							<div class="form-group col-md-4">
								<label for="registry_add">Matrícula</label>
								<input type="text" class="form-control" id="registry_add" name="registry">
							</div>
							<div class="form-group col-md-4">
								<label for="date_birth_add">Data de Nascimento</label>
								<input type="date" class="form-control" id="date_birth_add" name="date_birth">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="password_add">Senha</label>
								<input type="password" class="form-control" id="password_add" name="password" autocomplete="new-password">
							</div>
							<div class="form-group col-md-6">
								<label for="conf_password_add">Confirmar Senha</label>
								<input type="password" class="form-control" id="conf_password_add" name="conf_password">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button id="btn_add" type="submit" class="btn btn-primary">Salvar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- *********************************************************************************************************************** -->
</div> <!-- /.box -->