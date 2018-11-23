<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="box">

	<h3 class="box-title">Local</h3>

	<table id="local_table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Local</th>
				<th>Campus</th>
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
					<h5 class="modal-title">Editar Local</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formEditLocal" method="post">
						<div class="form-group">
							<label for="local_edit">Local</label>
							<input name="local" type="text" class="form-control" id="local_edit">
						</div>
						<div class="form-group">
							<label for="campus_edit">Campus</label>
							<select id="campus_edit" class="form-control" name="campus">
								<option value=""></option>
								<?php foreach ($campus as $row): ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->campus; ?></option>
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
					<h5 class="modal-title">Adicionar Local</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formAddLocal" method="post">
						<div class="form-group">
							<label for="local_add">Local</label>
							<input name="local" type="text" class="form-control" id="local_add">
						</div>
						<div class="form-group">
							<label for="campus_add">Campus</label>
							<select id="campus_add" class="form-control" name="campus">
								<option value=""></option>
								<?php foreach ($campus as $row): ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->campus; ?></option>
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