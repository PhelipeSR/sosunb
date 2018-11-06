function inserir_denuncia(dados = null){
	console.log(dados)
	var html =
		'<div>'+
			'<button data-id="'+dados.id+'" class="btn btn-danger btn-remove-denuncia mr-1">Remover</button>'+
			'<button data-id="'+dados.id+'" class="btn btn-success btn-mater-denuncia">Mater</button>'+
		'</div>';
	$('#conteudo_denuncia').empty().append(html);
}

function process_complaint(id, remove = null){
	$.ajax({
		url: base_url('admin/demands/process_complaint'),
		method: 'POST',
		data: {id: id,remove: remove},
		success: function(data, textStatus, jqXHR) {
			if (data.erro) {
				toastr.error(data.msg_erro, "Falha");
			}else{
				console.log(data.dados);
				var total = parseInt($('#cont_complaint').html());
				$('#cont_complaint').html(total-1)
				$('#denunciaModal').modal('hide');
			}
		},
	}); // Fim do Ajax
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
					inserir_denuncia(data.dados)
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