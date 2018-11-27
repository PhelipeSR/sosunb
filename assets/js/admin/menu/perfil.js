function show_erro(msg, selector){
	$(selector).append(`
		<div class="row justify-content-center" id="erroFeed">
			<div class="col border py-3 shadow-sm bg-white">
				<div class="alert alert-danger" role="alert">
					${msg}
				</div>
			</div>
		</div>
	`);
}
$(document).ready(function() {

	$( "#formPerfil" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			name:       {required: true,maxlength: 100},
			email:      {required: true,email: true,maxlength: 100},
			identity:   {required: true,integer: true,maxlength: 20},
			registry:   {required: true,integer: true,maxlength: 20},
			date_birth: {required: true,date: true},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/perfil/update_dados'),
				method: 'post',
				dataType: 'json',
				data: $('#formPerfil').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else if(data.dados == 'ok') {
						$('.form-control').removeClass('is-valid');
						$('.nome-perfil').html($('#name').val())
						toastr.success('Edição realizada com sucesso', "Sucesso");
					}
				},
				beforeSend: function(){
					$('#btn_dados').prop("disabled",true).html('<i class="fa fa-spin fa-spinner"></i> Salvar');
				},
				complete: function(){
					$('#btn_dados').prop("disabled",false).html("Salvar");
				},
			}); // Fim do Ajax
		},
	});

	$( "#formSenhas" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			current_password: {required: true,minlength: 6},
			new_password:     {required: true,minlength: 6},
			confirm_password: {required: true,equalTo: "#new_password"},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/perfil/update_senhas'),
				method: 'post',
				dataType: 'json',
				data: $('#formSenhas').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else if(data.dados == 'ok') {
						$('.form-control').removeClass('is-valid');
						$('#formSenhas')[0].reset();
						toastr.success('Edição realizada com sucesso', "Sucesso");
					}
				},
				beforeSend: function(){
					$('#btn_senhas').prop("disabled",true).html('<i class="fa fa-spin fa-spinner"></i> Salvar');
				},
				complete: function(){
					$('#btn_senhas').prop("disabled",false).html("Salvar");
				},
			}); // Fim do Ajax
		},
	});

	$( "#formImage" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			image_profile: {required: true},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/perfil/update_image'),
				method: 'post',
				dataType: 'json',
				data: new FormData($('#formImage')[0]),
				cache: false,
				contentType: false,
				processData: false,
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else{
						console.log(data)
						$('.img-perfil').attr("src", base_url('uploads/perfil/'+data.dados.image_name));
						$('.form-control').removeClass('is-valid');
						$('#image_profile').val('');
						toastr.success('Edição realizada com sucesso', "Sucesso");
					}
				},
				beforeSend: function(){
					$('#btn_image').prop("disabled",true).html('<i class="fa fa-spin fa-spinner"></i> Salvar');
				},
				complete: function(){
					$('#btn_image').prop("disabled",false).html("Salvar");
				},
			}); // Fim do Ajax
		},
	});

	$( "#formExcluirConta" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			password: {required: true,minlength: 6},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/perfil/delete_perfil'),
				method: 'post',
				dataType: 'json',
				data: $('#formExcluirConta').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else{
						window.location.replace(base_url());
					}
				},
				beforeSend: function(){
					$('#btn_excluir').prop("disabled",true).html('<i class="fa fa-spin fa-spinner"></i> Excluir');
				},
				complete: function(){
					$('#btn_excluir').prop("disabled",false).html("Excluir");
				},
			}); // Fim do Ajax
		},
	});
	var demands_perfil;
	$.ajax({
		url: base_url('admin/menu/perfil/get_demands'),
		method: 'post',
		dataType: 'json',
		data: $('#formPerfil').serialize(),
		success: function(data, textStatus, jqXHR) {
			if (data.erro) {
				toastr.error(data.msg_erro, "Falha");
			}else {
				demands_perfil = data.dados;
				if (demands_perfil.reclamacao.length) {
					demands_perfil.reclamacao.forEach(function(item) {
						add_demand(item, '#feedPerfilReclamacoes', false);
					});
				}else{
					show_erro('Nenhuma reclamação foi feita.','#feedPerfilReclamacoes');
				}
			}
		},
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var id = e.target.id;
		$('#feedPerfilReclamacoes').empty();
		$('#feedPerfilSugestoes').empty();
		$('#feedPerfilCurtidas').empty();
		$('#feedPerfilComentadas').empty();

		if (id == 'v-pills-reclamacoes-tab') {
			if (demands_perfil.reclamacao.length) {
				demands_perfil.reclamacao.forEach(function(item) {
					add_demand(item, '#feedPerfilReclamacoes', false);
				});
			}else{
				show_erro('Nenhuma reclamação foi feita.','#feedPerfilReclamacoes');
			}
		}
		if (id == 'v-pills-sugestoes-tab') {
			if (demands_perfil.sugestao.length) {
				demands_perfil.sugestao.forEach(function(item) {
					add_demand(item, '#feedPerfilSugestoes', false);
				});
			}else{
				show_erro('Nenhuma sugestão foi feita.','#feedPerfilSugestoes');
			}
		}
		if (id == 'v-pills-curtidas-tab') {
			if (demands_perfil.likes.length) {
				demands_perfil.likes.forEach(function(item) {
					add_demand(item, '#feedPerfilCurtidas', false);
				});
			}else{
				show_erro('Nenhuma demanda foi curtida.','#feedPerfilCurtidas');
			}
		}
		if (id == 'v-pills-comentadas-tab') {
			if (demands_perfil.comentarios.length) {
				demands_perfil.comentarios.forEach(function(item) {
					add_demand(item, '#feedPerfilComentadas', false);
				});
			}else{
				show_erro('Nenhuma demanda foi comentada.','#feedPerfilComentadas');
			}
		}
	});

});