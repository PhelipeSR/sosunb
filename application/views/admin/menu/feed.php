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
					<?php foreach ($status as $row): ?>
						<?php echo '<option value="'.$row->id.'">'.$row->status.'</option>'; ?>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>

	<div class="row justify-content-center my-3">
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