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
				$('#erroFeed').remove();
				$('#demandsFeed').append(`
					<div class="row justify-content-center mt-4" id="erroFeed">
						<div class="col-lg-8 col-xl-6 border py-3 shadow-sm bg-white">
							<div class="alert alert-danger" role="alert">
								${data.msg_erro}
							</div>
						</div>
					</div>
				`);
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

	$('#erroFeed').remove();
	get_demand();

	$('#statusFeed').change(function(event) {
		limit = 0
		$('#erroFeed').remove();
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

	var typingTimer; //timer identifier

	//on keyup, start the countdown
	$('#searchFeed').keyup(function(event) {
		clearTimeout(typingTimer);
		typingTimer = setTimeout(function(){
			limit = 0
			$('#erroFeed').remove();
			$('#demandsFeed').empty();
			get_demand();
		}, 500);
	});
});