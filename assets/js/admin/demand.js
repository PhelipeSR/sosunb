function add_demand(data, selector) {

	var html =`
		<div class="row justify-content-center mt-4" id="divDemanda${data.demand_id}">
			<div class="col-lg-8 col-xl-6 border py-3 shadow-sm bg-white">
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
					<span class="float-right">
						<div class="dropdown dropleft">
							<button class="btn btn-link pr-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">`;
								if (data.owner_demands == 'true') {
									html += `<a data-demand_id="${data.demand_id}" class="dropdown-item  btn-apagar" href="javascript:void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i> Apagar</a>`;
								}
								html += `
								<a data-demand_id="${data.demand_id}" class="dropdown-item btn-denunciar" href="#"><i class="fa fa-ban" aria-hidden="true"></i> Denunciar</a>
							</div>
						</div>
					</span>
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
					<span class="m-0 float-lg-left"><span><i class="fa fa-thumbs-up"></i></span> ${data.total_likes} </span>
					<span><a href="javascript:void(0);" data-demand_id="${data.demand_id}"  id="vercomentarios${data.demand_id}" class="m-0 float-right ver-comentarios">${data.comments.length + data.answers.length} Comentarios</a></span>
				</div>
				<div class="border-top border-bottom">
					<div class="row">
						<div class="col pr-0">
							<div class="${(data.gave_like == 'true') ? 'text-primary' : 'text-muted'} btn-curtir text-center py-2 actions" data-gave="${data.gave_like}" data-demand_id="${data.demand_id}">
								<h5 class="m-0"><span><i class="fa fa-thumbs-up"></i></span> Curtir</h5>
							</div>
						</div>
						<div class="col pl-0">
							<div class="text-muted text-center py-2 actions btn-comentar" data-demand_id="${data.demand_id}">
								<h5 class="m-0"><span><i class="fa fa-comments-o"></i></span> Comentar</h5>
							</div>
						</div>
					</div>
				</div>
				<div style="display: none;" id="comentarios${data.demand_id}">`;
					data.answers.forEach(function(resposta){
						html += `
						<div class="media d-flex align-items-center mt-2 rounded">
							<img class="img-fluid mr-3 ml-1 radius-50" style="max-width: 50px" src="${resposta.image_profile}">
							<div class="media-body pl-3 rounded" style="background-color: #a7a7a7;">
								<div class="row align-items-center">
									<div class="col-11 py-2">
										<span class="text-white">${resposta.name}</span><br>
										<span class="text-white">Passou a demanda de <span class="badge badge-info">${resposta.previous_status}</span> para <span class="badge badge-info">${resposta.current_status}</span></span><br>
										<span class="text-white">${resposta.comment}</span>
									</div>
									<div class="col-1">`
										if (resposta.owner_answer == 'true') {
											html += `<a class="dropdown-item float-right text-white" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>`
										}
									html += `
									</div>
								</div>
								<span class="text-white float-right pr-2" style="font-size: 12px;">${resposta.created_date}</span>
							</div>`;
						html += `
						</div>`;
					});
					data.comments.forEach(function(comments){
						html += `
						<div class="media d-flex align-items-center mt-2 rounded">
							<img class="img-fluid mr-3 ml-1 radius-50" style="max-width: 50px" src="${comments.image_profile}">
							<div class="media-body pl-3 rounded bg-light">
								<div class="row align-items-center">
									<div class="col-11 py-2">
										<span class="text-primary">${comments.name}</span><br>
										<span class="text-muted">${comments.comment}</span>
									</div>
									<div class="col-1">`
										if (comments.owner_comment == 'true') {
											html += `<a class="dropdown-item float-right text-muted" href="javascript:void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i></a>`
										}
									html += `
									</div>
								</div>
								<span class="text-muted float-right pr-2" style="font-size: 12px;">${comments.created_date}</span>
							</div>`;
						html += `
						</div>`;
					});
				html += `
				</div>
				<div class="mt-2 inputWithIcon" style="display: none;" id="divComentario${data.demand_id}">
					<input id="inputComentario${data.demand_id}" class="form-control comment-demand-input" type="text" name="search" placeholder="Escreva seu comentário">
					<a class="pointer" href="javascript:void(0);"><i class="fa fa-mail-forward"></i></a>
				</div>
			</div>
		</div>`;

	$(selector).append(html);
}

$(document).ready(function($) {

	$(document).on('click', '.ver-comentarios', function(event) {
		var demand_id = $(this).data('demand_id');
		$('#comentarios'+demand_id).show(600);
		$('#divComentario'+demand_id).show(600);
	});

	$(document).on('click', '.btn-comentar', function(event) {
		var demand_id = $(this).data('demand_id');
		$('#comentarios'+demand_id).show(600);
		$('#divComentario'+demand_id).show(100);
		$('html, body').animate({
			scrollTo: $('#inputComentario'+demand_id).offset().top + -200
		}, 400, function(){
			$('#inputComentario'+demand_id).focus();
		});
	});

	$(document).on('click', '.btn-curtir', function(event) {
		var demand_id = $(this).data('demand_id');
		var div = $(this)
		if (div.data('gave')) {
			div.data('gave',false);
			div.removeClass('text-primary').addClass('text-muted');
			$.ajax({
				url: base_url('admin/menu/demands/delete_like/'),
				method: 'POST',
				data: {'demands_id': demand_id},

				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
						div.removeClass('text-muted').addClass('text-primary');
					}
				},
			}); // Fim do Ajax
		}else{
			div.data('gave',true);
			div.removeClass('text-muted').addClass('text-primary');
			$.ajax({
				url: base_url('admin/menu/demands/add_like/'),
				method: 'POST',
				data: {'demands_id': demand_id},

				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
						div.removeClass('text-primary').addClass('text-muted');
					}
				},
			}); // Fim do Ajax
		}
	});

	var denuncia_demand_id = 0;
	$(document).on('click', '.btn-denunciar', function(event) {
		var demand_id = $(this).data('demand_id');
		denuncia_demand_id = demand_id;
		$('#modalDenunciar').modal('show');
	});

	$('#denunciarConfirm').click(function(event) {
		$('#modalDenunciar').modal('hide');
		$.ajax({
			url: base_url('admin/menu/demands/report_demands/'),
			method: 'POST',
			data: {'demands_id': denuncia_demand_id},

			success: function(data, textStatus, jqXHR) {
				if (data.erro) {
					toastr.error(data.msg_erro, "Falha");
				}else{
					$('#divDemanda'+denuncia_demand_id).html('<div class="col-lg-8 col-xl-6 border py-3 shadow-sm bg-white"><p class="m-0">Demanda Denunciada</p></div>');
				}
			},
		}); // Fim do Ajax
	});

	var apagar_demand_id = 0;
	$(document).on('click', '.btn-apagar', function(event) {
		var demand_id = $(this).data('demand_id');
		apagar_demand_id = demand_id;
		$('#modalApagar').modal('show');
	});

	$('#apagarConfirm').click(function(event) {
		$('#modalApagar').modal('hide');
		$.ajax({
			url: base_url('admin/menu/demands/delete_demands/'),
			method: 'POST',
			data: {'demands_id': apagar_demand_id},

			success: function(data, textStatus, jqXHR) {
				if (data.erro) {
					toastr.error(data.msg_erro, "Falha");
				}else{
					$('#divDemanda'+apagar_demand_id).html('<div class="col-lg-8 col-xl-6 border py-3 shadow-sm bg-white"><p class="m-0">Demanda Deletada</p></div>');
				}
			},
		}); // Fim do Ajax
	});

});