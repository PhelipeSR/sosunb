$(document).ready( function() {

	$('#status').click(function() {
		window.history.replaceState({page: 'status'}, 'status', '#status');
		$('.app-menu>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/status/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/status.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

	$('#perfil').click(function() {
		window.history.replaceState({page: 'perfil'}, 'perfil', '#perfil');
		$('.app-menu>li>a').removeClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/perfil/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/perfil.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

	$('#tipo-demanda').click(function() {
		window.history.replaceState({page: 'tipo-demanda'}, 'tipo-demanda', '#tipo-demanda');
		$('.app-menu>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/type_demand/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/type_demand.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

});

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}