$(document).ready(function($) {

	$.ajax({
		url: base_url('admin/menu/ranking/get_ranking/'),
		method: 'POST',
		data: {'campus': $('#campusRanking').val()},

		success: function(data, textStatus, jqXHR) {
			if (data.erro) {
				toastr.error(data.msg_erro, "Falha");
			}else{
				data.dados.forEach(function(item) {
					add_demand(item, '#demandsRanking')
				});
			}
		},
	}); // Fim do Ajax
});