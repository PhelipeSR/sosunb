function show_erros(mensagem) {
	var html =
	'<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
		'<strong>'+mensagem+'</strong>'+
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
			'<span aria-hidden="true">×</span>'+
		'</button>'+
	'</div>';
	$('#show_mensage').empty().append(html)
}

function show_erros_recuperacao(mensagem) {
	var html =
	'<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
		'<strong>'+mensagem+'</strong>'+
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
			'<span aria-hidden="true">×</span>'+
		'</button>'+
	'</div>';
	$('#show_mensage_recuperacao').empty().append(html)
}

function show_sucesso(mensagem) {
	var html =
	'<div class="alert alert-success alert-dismissible fade show" role="alert">'+
		'<strong>'+mensagem+'</strong>'+
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
			'<span aria-hidden="true">×</span>'+
		'</button>'+
	'</div>';
	$('#show_mensage_recuperacao').empty().append(html);
}
$(document).ready(function() {

	$("#formLogin").validate({
		rules: {
			email: {required: true,email: true},
			password: {required: true,minlength: 6},
		},
		errorClass: 'invalid-feedback',
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('authentication/'),
				method: 'POST',
				data: $("#formLogin").serialize(),

				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						show_erros(data.msg_erro);
						$('input[name=password]').val('').removeClass('is-valid');
					}else if(data.dados.user_type == 1) {
						window.location.replace(base_url('usuario/'));
					}
					else if(data.dados.user_type == 2) {
						window.location.replace(base_url('administrador/'));
					}
					else if(data.dados.user_type == 3) {
						window.location.replace(base_url('gestor/'));
					}
				},
				beforeSend: function(){
					$('#btnLogin')
						.prop("disabled",true)
						.html("<i class='fa fa-spinner fa-spin'></i> LOGIN");
				},
				complete: function(){
					$('#btnLogin')
						.prop("disabled",false)
						.html("<i class='fa fa-sign-in'></i> LOGIN");
				},
			}); // Fim do Ajax
		},
	});

	$("#formRecoperacao").validate({
		rules: {
			email: {required: true,email: true},
		},
		errorClass: 'invalid-feedback',
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('recuperar/'),
				method: 'POST',
				data: $("#formRecoperacao").serialize(),

				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						show_erros_recuperacao(data.msg_erro);
					}else{
						$('input').val('').removeClass('is-valid');
						show_sucesso('Enviamos um email para recuperação.')
					}
				},
				beforeSend: function(){
					$('#btnResetar')
						.prop("disabled",true)
						.html("<i class='fa fa-spinner fa-spin'></i> RESETAR");
				},
				complete: function(){
					$('#btnResetar')
						.prop("disabled",false)
						.html("<i class='fa fa-unlock fa-lg fa-fw'></i> RESETAR");
				},
			}); // Fim do Ajax
		},
	});
});