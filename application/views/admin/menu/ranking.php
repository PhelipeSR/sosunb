<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="box">
	<h3 class="box-title">Ranking</h3>
	<div class="row justify-content-center mb-3">
		<div class="col-lg-8 col-xl-6 p-0">
			<div class="input-group">
				<div class="input-group-prepend">
					<label class="input-group-text" for="campusRanking">Campus</label>
				</div>
				<select name="campus" id="campusRanking" class="custom-select">
					<option value="" selected>Todos</option>
					<?php foreach ($campus as $row): ?>
						<?php echo '<option value="'.$row->id.'">'.$row->campus.'</option>'; ?>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>

	<div id="demandsRanking"></div>

</div> <!-- /.box -->