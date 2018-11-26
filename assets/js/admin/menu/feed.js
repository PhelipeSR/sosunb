function get_demand(){
	var status = $('#statusFeed').val();
	var search = $('#searchFeed').val();
	$.ajax({
		url: base_url('admin/menu/feed/get_feed/'),
		method: 'POST',
		data: {
			'status': status,
			'search': search,
			'limit': limit
		},
		success: function(data, textStatus, jqXHR) {
			liberado = true;
			if (data.erro) {
				toastr.error(data.msg_erro, "Falha");
			}else{
				data.dados.forEach(function(item) {
					add_demand(item, '#demandsFeed')
				});
			}
		},
	}); // Fim do Ajax
}

var limit = 0;
var liberado = false;

$(document).ready(function($) {

	get_demand();

	$('#statusFeed').change(function(event) {
		limit = 0
		$('#demandsFeed').empty();
		get_demand();
	});

	$('#searchFeed').keyup(function(event) {
		limit = 0
		$('#demandsFeed').empty();
		get_demand();
	});

	$(window).scroll(function() {
		if(($(window).scrollTop() + $(window).height() > $(document).height() - 300) && liberado) {
			liberado = false;
			limit += 5;
			get_demand();
		}
	});
});