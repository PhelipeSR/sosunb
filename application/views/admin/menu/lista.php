<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="box">

	<h3 class="box-title">Demandas</h3>


	<table id="lista_table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Imagem</th>
				<th>Título</th>
				<th>Status</th>
				<th>Tipo Demanda</th>
				<th>Tipo Problema</th>
				<th>Local</th>
				<th>Campus</th>
				<th>Operações</th>
			</tr>
		</thead>
	</table>

<!-- *********************************************************************************************************************** -->

	<!-- Modal Editar Local-->
	<div class="modal fade" id="modalVerLocal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar Local</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><small class="text-muted">Isso mudara o status da demanda para <span class="badge badge-warning">Em Análise</span></small></p>
					<form id="formEditLocal" method="post">
						<div class="form-row">
							<div class="form-group col">
								<label for="campus_edit">Campus</label>
								<select id="campus_edit" class="form-control" name="campus_id">
									<?php foreach ($campus as $row): ?>
										<option value="<?php echo $row->id; ?>"><?php echo $row->campus; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label for="area_edit">Área</label>
								<select id="area_edit" class="form-control" name="area_id">
									<?php foreach ($area as $row): ?>
										<option value="<?php echo $row->id; ?>"><?php echo $row->area; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-row" id="local_edit_div" style="display: none;">
							<div class="form-group col">
								<label for="local_edit">Local</label>
								<select id="local_edit" class="form-control" name="local_id">
									<option value="" selected></option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label for="environment_edit">Ambiente</label>
								<select id="environment_edit" class="form-control" name="environment_id">
									<option value="" selected></option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label for="comment_local">Comentário</label>
								<textarea id="comment_local" rows="3" name="comment" class="form-control"></textarea>
							</div>
						</div>
						<input type="hidden" name="id" id="id_idit_local">
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button id="btn_edit_local" type="submit" class="btn btn-primary">Salvar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- *********************************************************************************************************************** -->

<!-- *********************************************************************************************************************** -->

	<!-- Modal Editar Problema-->
	<div class="modal fade" id="modalVerProblema" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar Tipo de Problema</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><small class="text-muted">Isso mudara o status da demanda para <span class="badge badge-warning">Reclassificada</span></small></p>
					<form id="formEditProblema" method="post">
						<div class="form-row">
							<div class="form-group col">
								<label for="type_problems_edit">Tipo de Problema</label>
								<select id="type_problems_edit" class="form-control" name="type_problems_id">
									<?php foreach ($type_problem as $row): ?>
										<option value="<?php echo $row->id; ?>"><?php echo $row->type; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label for="comment_problema">Comentário</label>
								<textarea id="comment_problema" rows="3" name="comment" class="form-control"></textarea>
							</div>
						</div>
						<input type="hidden" name="id" id="id_idit_problema">
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button id="btn_edit_problema" type="submit" class="btn btn-primary">Salvar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- *********************************************************************************************************************** -->

<!-- *********************************************************************************************************************** -->

	<!-- Modal Editar Status-->
	<div class="modal fade" id="modalVerStatus" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar Status</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><small class="text-muted">Isso mudara o status da demanda para <span class="badge badge-warning" id="badgeStatus">Reclassificada</span></small></p>
					<form id="formEditStatus" method="post">
						<div class="form-row">
							<div class="form-group col">
								<label for="status_edit">Status</label>
								<select id="status_edit" class="form-control" name="status_id">
									<?php foreach ($status as $row): ?>
										<option value="<?php echo $row->id; ?>"><?php echo $row->status; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label for="comment_status">Comentário</label>
								<textarea id="comment_status" rows="3" name="comment" class="form-control"></textarea>
							</div>
						</div>
						<input type="hidden" name="id" id="id_idit_status">
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button id="btn_edit_status" type="submit" class="btn btn-primary">Salvar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- *********************************************************************************************************************** -->

<!-- *********************************************************************************************************************** -->
	<!-- Modal Ver Demanda-->
	<div class="modal fade" id="modalVerDemanda" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg bg-light" role="document">
			<div class="modal-content">
				<div class="modal-header pb-0 border-0">
					<h5 class="modal-title">Ver Demanda</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="demandsVerLista"></div>
				</div>
				<div class="modal-footer border-0 pt-0">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
				</div>
			</div>
		</div>
	</div>

<!-- *********************************************************************************************************************** -->
</div> <!-- /.box -->