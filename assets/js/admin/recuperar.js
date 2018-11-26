function show_erros(mensagem) {
	var html =
	'<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
		'<strong>'+mensagem+'</strong>'+
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
			'<span aria-hidden="true">×</span>'+
		'</button>'+
	'</div>';
	$('#show_mensage').empty().append(html);
}

function show_sucesso(mensagem) {
	var html =
	'<div class="alert alert-success alert-dismissible fade show" role="alert">'+
		'<strong>'+mensagem+'</strong>'+
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
			'<span aria-hidden="true">×</span>'+
		'</button>'+
	'</div>';
	$('#show_mensage').empty().append(html);
}
$(document).ready(function() {

	$("#formRecuperar").validate({
		rules: {
			confPassword: {required: true,equalTo: "#password"},
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
				url: base_url('process-recover/'),
				method: 'POST',
				data: $("#formRecuperar").serialize(),

				success: function(data, textStatus, jqXHR) {
					console.log(data)
					if (data.erro) {
						show_erros(data.msg_erro);
					}else{
						$('input').val('').removeClass('is-valid');
						show_sucesso('Senha atualizada com sucesso');
					}
				},
				beforeSend: function(){
					$('#btnRecuperar')
						.prop("disabled",true)
						.html("<i class='fa fa-spinner fa-spin'></i> RECUPERAR");
				},
				complete: function(){
					$('#btnRecuperar')
						.prop("disabled",false)
						.html("<i class='fa fa-sign-in'></i> RECUPERAR");
				},
			}); // Fim do Ajax
		},
	});
});