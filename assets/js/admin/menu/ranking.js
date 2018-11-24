$(document).ready(function($) {

	$.ajax({
		url: base_url('get-demands/ranking/'),
		method: 'POST',
		data: {'campus': $('#campusRanking').val()},

		success: function(data, textStatus, jqXHR) {
			console.log(data)
		},
	}); // Fim do Ajax

});