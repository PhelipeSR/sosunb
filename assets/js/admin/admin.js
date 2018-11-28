function process_complaint(id, remove = null){
	$.ajax({
		url: base_url('admin/demands/process_complaint'),
		method: 'POST',
		data: {id: id,remove: remove},
		success: function(data, textStatus, jqXHR) {
			if (data.erro) {
				toastr.error(data.msg_erro, "Falha");
			}else{
				var total = parseInt($('#cont_complaint').html());
				$('#cont_complaint').html(total-1)
				$('#complaint_content_'+data.dados).remove();
				$('#denunciaModal').modal('hide');
			}
		},
	}); // Fim do Ajax
}

function add_demand_denuncia(data, selector){
	var html =`
	<div class="row px-4 justify-content-center mt-4" id="divDemanda${data.demand_id}">
		<div class="col border py-3 shadow-sm bg-white">
			<div class="media d-flex align-items-center">
				<img class="img-fluid mr-3 radius-50" style="max-width: 50px" src="${data.image_profile}">
				<div class="media-body">
					<span class="text-primary">${data.name}</span>
					<span class="text-muted"> publicou uma ${data.type_demand}</span>
					<span class="text-muted float-right d-none d-sm-block" style="font-size: 12px;">${data.created_date}</span>
					<br><span class="text-muted"><i class="mr-1 fa fa-map-marker text-primary"></i>${data.environment}</span>`;
					if (data.local) {
						html += `<span class="text-muted"> - ${data.local}</span>`;
					}
				html += `
					<span class="text-muted"> - ${data.campus}</span>
				</div>
			</div>
			<div class="mt-3">
				<h4 class="font-weight-bold">${data.title}</h4>
			</div>
			<div class="w-100 text-center mt-3" style="height: 300px">
				<img class="img-fluid" style="height:100%;object-fit:cover;" src="${data.image_demand}" alt="">
			</div>
			<div class="mt-3">
				<p class="text-muted">${data.description}</p>
			</div>
			<div class="clearfix my-2 text-primary">
				<span class="m-0 float-lg-left"><span><i class="fa fa-thumbs-up"></i></span> <span id="numLikes${data.demand_id}">${data.total_likes}</span> </span>
				<span><a href="javascript:void(0);" data-demand_id="${data.demand_id}"  id="vercomentarios${data.demand_id}" class="m-0 float-right ver-comentarios"><span id="numComentarios${data.demand_id}">${data.comments.length + data.answers.length}</span> Comentarios</a></span>
			</div>
			<div style="display: none;" id="comentarios${data.demand_id}">`;
				data.answers.forEach(function(resposta){
					html += `
					<div class="media d-flex align-items-center mt-2 rounded">
						<img class="img-fluid mr-3 ml-1 radius-50" style="max-width: 50px" src="${resposta.image_profile}">
						<div class="media-body pl-3 rounded" style="background-color: #a7a7a7;">
							<div class="row align-items-center">
								<div class="col py-2">
									<span class="text-white">${resposta.name}</span><br>
									<span class="text-white">Passou a demanda de <span class="badge badge-info">${resposta.previous_status}</span> para <span class="badge badge-info">${resposta.current_status}</span></span><br>
									<span class="text-white">${resposta.comment}</span>
								</div>
							</div>
							<span class="text-white float-right pr-2" style="font-size: 12px;">${resposta.created_date}</span>
						</div>`;
					html += `
					</div>`;
				});
				data.comments.forEach(function(comments){
					html += `
					<div class="media d-flex align-items-center mt-2 rounded" id="sessionComentario${comments.comment_id}">
						<img class="img-fluid mr-3 ml-1 radius-50" style="max-width: 50px" src="${comments.image_profile}">
						<div class="media-body pl-3 rounded bg-light">
							<div class="row align-items-center">
								<div class="col-11 py-2">
									<span class="text-primary">${comments.name}</span><br>
									<span class="text-muted">${comments.comment}</span>
								</div>
							</div>
							<span class="text-muted float-right pr-2" style="font-size: 12px;">${comments.created_date}</span>
						</div>`;
					html += `
					</div>`;
				});
			html += `
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button data-id="${data.demand_id}" class="btn btn-danger btn-remove-denuncia mr-1">Remover</button>
		<button data-id="${data.demand_id}" class="btn btn-success btn-mater-denuncia">Manter</button>
	</div>
	`;

	$(selector).append(html);
}

$(document).ready(function($) {

	// Pega a reclamação que será analisada
	$(document).on('click', '.demands-complaint', function(event) {
		var id = $(this).data('id-demands');
		$.ajax({
			url: base_url('admin/demands/get_demans_info'),
			method: 'POST',
			data: {id: id},
			success: function(data, textStatus, jqXHR) {
				if (data.erro) {
					toastr.error(data.msg_erro, "Falha");
				}else{
					$('#demandsDenunciaModal').empty();
					data.dados.forEach(function(item) {
						add_demand_denuncia(item, '#demandsDenunciaModal')
					});
					$('#denunciaModal').modal('show');
				}
			},
		}); // Fim do Ajax
	});

	// processando reclamação (manter)
	$(document).on('click', '.btn-mater-denuncia', function(event) {
		var id = $(this).data('id');
		process_complaint(id)
	});
	// processando reclamação (excluir)
	$(document).on('click', '.btn-remove-denuncia', function(event) {
		var id = $(this).data('id');
		process_complaint(id,true)
	});
});