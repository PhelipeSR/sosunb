$(document).ready( function() {

	$('#usuarios').click(function() {
		$(window).unbind('scroll');
		window.history.replaceState({page: 'usuarios'}, 'usuarios', '#usuarios');
		$('ul>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/user/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/user.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

	$('#status').click(function() {
		$(window).unbind('scroll');
		window.history.replaceState({page: 'status'}, 'status', '#status');
		$('ul>li>a').removeClass('active');
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
		$(window).unbind('scroll');
		window.history.replaceState({page: 'perfil'}, 'perfil', '#perfil');
		$('ul>li>a').removeClass('active');
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
		$(window).unbind('scroll');
		window.history.replaceState({page: 'tipo-demanda'}, 'tipo-demanda', '#tipo-demanda');
		$('ul>li>a').removeClass('active');
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

	$('#local').click(function() {
		$(window).unbind('scroll');
		window.history.replaceState({page: 'local'}, 'local', '#local');
		$('ul>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/local/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/local.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

	$('#campus').click(function() {
		$(window).unbind('scroll');
		window.history.replaceState({page: 'campus'}, 'campus', '#campus');
		$('ul>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/campus/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/campus.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

	$('#area').click(function() {
		$(window).unbind('scroll');
		window.history.replaceState({page: 'area'}, 'area', '#area');
		$('ul>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/area/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/area.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

	$('#ambiente').click(function() {
		$(window).unbind('scroll');
		window.history.replaceState({page: 'ambiente'}, 'ambiente', '#ambiente');
		$('ul>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/environment/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/environment.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

	$('#tipo-problema').click(function() {
		$(window).unbind('scroll');
		window.history.replaceState({page: 'tipo-problema'}, 'tipo-problema', '#tipo-problema');
		$('ul>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/type_problem/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/type_problem.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

	$('#categoria').click(function() {
		$(window).unbind('scroll');
		window.history.replaceState({page: 'categoria'}, 'categoria', '#categoria');
		$('ul>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/category/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/category.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

	$('#ranking').click(function() {
		$(window).unbind('scroll');
		window.history.replaceState({page: 'ranking'}, 'ranking', '#ranking');
		$('ul>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/ranking/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/ranking.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

	$('#feed').click(function() {
		$(window).unbind('scroll');
		window.history.replaceState({page: 'feed'}, 'feed', '#feed');
		$('ul>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/feed/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/feed.js') )
			.fail(function( jqxhr, settings, exception ) { console.log( 'Erro' ) });
		});
	});

	$('#lista').click(function() {
		$(window).unbind('scroll');
		window.history.replaceState({page: 'lista'}, 'lista', '#lista');
		$('ul>li>a').removeClass('active');
		$(this).addClass('active');
		// Remove visualizações anteriores
		$('.box').remove();
		// Adiciona o gif de loading
		$('#loading').html("<div id='loadingMenu' class='d-flex justify-content-center'><span class='border p-3 border-secondary h3 rounded shadow m-0'><i class='fa fa-spinner fa-spin'></i>&nbsp; Carregando conteúdo</span></div>");
		// Carrega o arquivo
		$('#ajax-content').load( base_url('admin/menu/lista/render/'),function( response, status, xhr ){
			$('#loadingMenu').remove(); // Retira o gif de loading
			$.getScript( base_url('assets/js/admin/menu/lista.js') )
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
  "preventDuplicates": true,
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