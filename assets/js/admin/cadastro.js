function show_msg(mensagem,type) {
	var html =
	'<div class="alert alert-'+type+' alert-dismissible fade show" role="alert">'+
		'<strong>'+mensagem+'</strong>'+
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
			'<span aria-hidden="true">×</span>'+
		'</button>'+
	'</div>';
	$('#show_mensage_cadastro').empty().append(html)
}
var troca = false;
$(document).ready(function() {
	$("#formCadastro").validate({
		rules: {
			name:          {required: true,maxlength: 100},
			email:         {required: true,email: true,maxlength: 100},
			identity:      {required: true,integer: true,maxlength: 20},
			registry:      {required: true,integer: true,maxlength: 20},
			date_birth:    {required: true,date: true},
			password:      {required: true,minlength: 6},
			conf_password: {required: true,equalTo: "#password"},
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
				url: base_url('cadastro/sign_up'),
				method: 'POST',
				data: $("#formCadastro").serialize(),

				success: function(data, textStatus, jqXHR) {
					$('.form-control').removeClass( "is-valid is-invalid focused");
					if (data.erro) {
						show_msg(data.msg_erro,'danger');
					}else {
						$('#formCadastro')[0].reset();
						show_msg('<button id="trocarLogin" class="btn btn-success" type="button">Fazer Login</button> Cadastro realizado com sucesso.','success');
					}
				},
				beforeSend: function(){
					$('#btnCadastro')
						.prop("disabled",true)
						.html("<i class='fa fa-spinner fa-spin'></i> LOGIN");
				},
				complete: function(){
					$('#btnCadastro')
						.prop("disabled",false)
						.html("<i class='fa fa-sign-in'></i> LOGIN");
				},
			}); // Fim do Ajax
		},
	});

	$(document).on('click', '#trocarLogin', function(event) {
		troca = true;
		$('#cadastroModal').modal('hide');
	});

	$('#cadastroModal').on('hidden.bs.modal', function (event) {
		if (troca) {
			$('#loginModal').modal('show');
			troca = false;
		}
	});
	$(document).on('hidden.bs.modal', function (event) {
		$('#show_mensage, #show_mensage_cadastro').empty();
		$('.form-control').removeClass( "is-valid is-invalid focused");
	});
});