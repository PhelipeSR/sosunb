<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="box">

	<h3 class="box-title">Área</h3>

	<table id="area_table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr>
				<th>ID</th>
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
					<h5 class="modal-title">Editar Área</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formEditArea" method="post">
						<div class="form-group">
							<label for="area_edit">Área</label>
							<input name="area" type="text" class="form-control" id="area_edit">
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
					<h5 class="modal-title">Adicionar Área</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formAddArea" method="post">
						<div class="form-group">
							<label for="area_add">Área</label>
							<input name="area" type="text" class="form-control" id="area_add">
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