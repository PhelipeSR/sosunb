<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="box">

	<h3 class="box-title">Tipo de Demanda</h3>

	<table id="type_demand_table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Demanda</th>
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
					<h5 class="modal-title">Editar Demanda</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formEditTypeDemand" method="post">
						<div class="form-group">
							<label for="demands_edit">Demanda</label>
							<input name="demands" type="text" class="form-control" id="demands_edit">
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
					<h5 class="modal-title">Adicionar Demanda</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formAddTypeDemand" method="post">
						<div class="form-group">
							<label for="demands_add">Demanda</label>
							<input name="demands" type="text" class="form-control" id="demands_add">
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