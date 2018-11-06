<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="box">

	<h3 class="box-title">Ambiente</h3>

	<table id="environment_table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Ambiente</th>
				<th>Área</th>
				<th>Operações</th>
			</tr>
		</thead>
	</table>

<!-- *********************************************************************************************************************** -->

	<!-- Modal Editar-->
	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar Ambiente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formEditEnvironment" method="post">
						<div class="form-group">
							<label for="environment_edit">Ambiente</label>
							<input name="environment" type="text" class="form-control" id="environment_edit">
						</div>
						<div class="form-group">
							<label for="area_edit">Área</label>
							<select id="area_edit" class="form-control" name="area">
								<option value=""></option>
								<?php foreach ($area as $row): ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->area; ?></option>
								<?php endforeach; ?>
							</select>
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
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Adicionar Ambiente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formAddEnvironment" method="post">
						<div class="form-group">
							<label for="environment_add">Ambiente</label>
							<input name="environment" type="text" class="form-control" id="environment_add">
						</div>
						<div class="form-group">
							<label for="area_add">Área</label>
							<select id="area_add" class="form-control" name="area">
								<option value=""></option>
								<?php foreach ($area as $row): ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->area; ?></option>
								<?php endforeach; ?>
							</select>
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