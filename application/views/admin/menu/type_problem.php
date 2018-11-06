<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="box">

	<h3 class="box-title">Tipo de Problema</h3>

	<table id="type_problem_table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Tipo de Problema</th>
				<th>Categoria</th>
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
					<h5 class="modal-title">Editar Tipo de Problema</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formEditTypeProblem" method="post">
						<div class="form-group">
							<label for="type_problem_edit">Tipo de Problema</label>
							<input name="type_problem" type="text" class="form-control" id="type_problem_edit">
						</div>
						<div class="form-group">
							<label for="category_edit">Categoria</label>
							<select id="category_edit" class="form-control" name="category">
								<option value=""></option>
								<?php foreach ($category as $row): ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->category; ?></option>
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
					<h5 class="modal-title">Adicionar Tipo de Problema</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formAddTypeProblem" method="post">
						<div class="form-group">
							<label for="type_problem_add">Tipo de Problema</label>
							<input name="type_problem" type="text" class="form-control" id="type_problem_add">
						</div>
						<div class="form-group">
							<label for="category_add">Categoria</label>
							<select id="category_add" class="form-control" name="category">
								<option value=""></option>
								<?php foreach ($category as $row): ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->category; ?></option>
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