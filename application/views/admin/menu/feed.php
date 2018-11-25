<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="box">
	<h3 class="box-title">Feed</h3>
	<div class="row justify-content-center">
		<div class="col-lg-8 col-xl-6 p-0">
			<div class="input-group">
				<div class="input-group-prepend">
					<label class="input-group-text" for="statusFeed">Status</label>
				</div>
				<select name="status" id="statusFeed" class="custom-select">
					<option value="" selected>Todos</option>
					<option value="1">Aberta</option>
					<option value="2">Reclassificada</option>
					<option value="3">Em Análise</option>
					<option value="4">Resolvida</option>
					<option value="5">Solução Inviável</option>
				</select>
			</div>
		</div>
	</div>

	<div class="row justify-content-center mt-3">
		<div class="col-lg-8 col-xl-6 p-0">
			<div class="input-group">
				<div class="input-group-prepend">
					<label class="input-group-text" for="searchFeed">Pesquisar</label>
				</div>
				<input type="text" name="search" class="form-control" id="searchFeed">
			</div>
		</div>
	</div>

	<div id="demandsFeed"></div>

</div> <!-- /.box -->