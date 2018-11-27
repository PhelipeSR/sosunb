function resset_form(seletor){
	$(seletor).validate().resetForm();
	$(seletor)[0].reset();
	$('.form-control').removeClass( "is-valid is-invalid focused");
}

function get_environment(campus, area, environment_id = '', local_id = ''){
	$.ajax({
		url: base_url('admin/menu/lista/get_environment'),
		method: 'post',
		dataType: 'json',
		data: {
			campus: campus,
			area: area
		},
		success: function(data, textStatus, jqXHR) {
			if (data.erro) {
				toastr.error(data.msg_erro, "Falha");
			}else{
				var html = '';
				data.dados.environment.forEach(function(item){
					html += '<option value="'+item.id+'">'+item.environment+'</option>';
				});
				$('#environment_edit').empty().append(html).val(environment_id);

				if (data.dados.local.length) {
					var html = '<option value=""></option>';
					data.dados.local.forEach(function(item){
						html += '<option value="'+item.id+'">'+item.local+'</option>';
					});
					$('#local_edit').empty().append(html).val(local_id);
					$('#local_edit_div').show();
					$("#local_edit").rules( "add", {
						required: true,
						integer: true,
					});
				}else{
					$("#local_edit").rules( "remove", "required integer");
					$('#local_edit_div').hide();
				}
			}
		},
		beforeSend: function(){
			$('#btn_add').prop("disabled",true).html('<i class="fa fa-spin fa-spinner"></i> Salvar');
		},
		complete: function(){
			$('#btn_add').prop("disabled",false).html("Salvar");
		},
	}); // Fim do Ajax
}

$(document).ready(function() {

	var lista_table = $('#lista_table').DataTable({
		dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>B"+"<'row'<'col-sm-12'tr>>"+"<'row'<'col-sm-5'i><'col-sm-7'p>>",
		ajax: { url: base_url('admin/menu/lista/get_lista'), type: "post"},
		language: { url: base_url('assets/plugins/datatables/translation.json')},
		processing: true, // Ativa gif de processamento
		serverSide: true, // ativa o processamento no lado do servidor
		responsive: true, // Deixa a tabela responsiva
		order: [[ 0, "desc" ]], // Ordena por ID de forma decrescente

		columns: [
			{ data: "id"            },
			{ data: "image_demand", render: function(value, type, row, meta){
				return "<div class='text-center'><img width='50px' class='img-fluid' src='"+base_url('uploads/demandas/'+value)+"'></div>";
			}},
			{ data: "title"          },
			{ data: "status_id", render: function(value, type, row, meta) {
				if (value == '1') {
					return "<span class='badge badge-primary d-inline'>"+row.status+" </span><span class='d-inline'><button title='Editar status' class='btn btn-link ver-status' data-btn='"+row.id+"'><i class='fa fa-pencil'></i></button></span>";
				}else if(value == '2' || value == '3'){
					return "<span class='badge badge-warning d-inline'>"+row.status+" </span><span class='d-inline'><button title='Editar status' class='btn btn-link ver-status' data-btn='"+row.id+"'><i class='fa fa-pencil'></i></button></span>";
				}else if(value == '4'){
					return "<span class='badge badge-success d-inline'>"+row.status+" </span><span class='d-inline'><button title='Editar status' class='btn btn-link ver-status' data-btn='"+row.id+"'><i class='fa fa-pencil'></i></button></span>";
				}else if(value == '5'){
					return "<span class='badge badge-danger d-inline' >"+row.status+" </span><span class='d-inline'><button title='Editar status' class='btn btn-link ver-status' data-btn='"+row.id+"'><i class='fa fa-pencil'></i></button></span>";
				}
			}},
			{ data: "demands"      },
			{ data: "type", render: function(value, type, row, meta) {
				return row.category + ' - ' + value + "<button title='Editar Problema' class='btn btn-link ver-problema' data-btn='"+row.id+"'><i class='fa fa-pencil'></i></button>";
			}},
			{ data: "id", render: function(value, type, row, meta) {
				return '<button class="btn btn-link ver-local" data-btn="'+value+'"><i class="fa fa-eye" aria-hidden="true"></i> Ver Local</button>'
			}},
			{ data: "campus" },
			{ data: "id", render: function(value, type, row, meta) {
				if (row.excluded == 0) {
					return "<div class='btn-group'><button title='Ver Demanda' class='btn btn-info ver-demanda' data-btn='"+value+"'><i class='fa fa-edit'></i></button><button title='Visibilidade' class='btn btn-success excluir' data-excluded='1'  data-btn='"+value+"'><i class='fa fa-eye'></i></button></div>";
				}else{
					return "<div class='btn-group'><button title='Ver Demanda' class='btn btn-info ver-demanda' data-btn='"+value+"'><i class='fa fa-edit'></i></button><button title='Visibilidade' class='btn btn-danger excluir' data-excluded='0'  data-btn='"+value+"'><i class='fa fa-eye-slash'></i></button></div>";
				}
			}},
		],
		buttons: [
			{
				className: 'btn btn-primary text-white',
				text: '<span class="glyphicon glyphicon-edit"> Adicionar</span>',
				action: function ( e, dt, type, indexes ) {
					resset_form('#formAddUser');
					$('#modalAdd').modal('show');
				}
			},
			'colvis',
		],
		createdRow: function ( row, data, index ) {
			$(row).attr('data-row',data.id);
		},
		columnDefs: [
			{
				targets: [0],
				visible: false
			},
			{
				targets: [1,8],
				orderable: false,
				width: "10%",
			},
		],
	}); // Fim Datatables

	$(document).off('click', '.excluir').on('click', '.excluir', function(){
		id = $(this).data('btn');
		excluded = $(this).data('excluded');
		$.ajax({
			url: base_url('admin/menu/lista/delete_lista'),
			method: 'post',
			dataType: 'json',
			data: {
				id: id,
				excluded: excluded
			},
			success: function(data, textStatus, jqXHR) {
				if (data.erro) {
					toastr.error(data.msg_erro, "Falha");
				}else if(data.dados == 'ok'){
					toastr.success('Visibilidade trocada com sucesso', "Sucesso");
					lista_table.ajax.reload( null, false );
				}
			},
			beforeSend: function(){
				$(this).prop("disabled",true);
			},
			complete: function(){
				$(this).prop("disabled",false);
			},
		}); // Fim do Ajax
	});

	$(document).off('click', '.ver-local').on('click', '.ver-local', function(){
		resset_form('#formEditLocal');
		var row = lista_table.row( $('[data-row="'+$(this).data('btn')+'"]') ).data();
		get_environment(row.campus_id,row.area_id, row.environment_id, row.local_id);
		$('#id_idit_local').val(row.id);
		$('#campus_edit').val(row.campus_id);
		$('#area_edit').val(row.area_id);
		$('#modalVerLocal').modal('show');
	});

	$(document).off('click', '.ver-problema').on('click', '.ver-problema', function(){
		resset_form('#formEditProblema');
		var row = lista_table.row( $('[data-row="'+$(this).data('btn')+'"]') ).data();
		$('#id_idit_problema').val(row.id);
		$('#type_problems_edit').val(row.type_problems_id);
		$('#modalVerProblema').modal('show');
	});

	$(document).off('click', '.ver-status').on('click', '.ver-status', function(){
		resset_form('#formEditStatus');
		var row = lista_table.row( $('[data-row="'+$(this).data('btn')+'"]') ).data();
		$('#id_idit_status').val(row.id);
		$('#status_edit').val(row.status_id);
		$('#modalVerStatus').modal('show');
	});

	$(document).off('click', '.ver-demanda').on('click', '.ver-demanda', function(){
		$('#demandsVerLista').empty();
		var row = lista_table.row( $('[data-row="'+$(this).data('btn')+'"]') ).data();
		$.ajax({
			url: base_url('admin/demands/get_demans_info'),
			method: 'POST',
			data: {id: row.id},
			success: function(data, textStatus, jqXHR) {
				if (data.erro) {
					toastr.error(data.msg_erro, "Falha");
				}else{
					$('#demandsDenunciaModal').empty();
					data.dados.forEach(function(item) {
						add_demand(item, '#demandsVerLista', false)
					});
					$('#modalVerDemanda').modal('show');
				}
			},
		}); // Fim do Ajax
	});

	$('#campus_edit').change(function(event) {
		get_environment($('#campus_edit').val(),$('#area_edit').val());
	});
	$('#area_edit').change(function(event) {
		get_environment($('#campus_edit').val(),$('#area_edit').val());
	});

	/* =====================================================================
	*  CRUD
	*  ===================================================================== */

	$( "#formEditLocal" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			campus_id:{required: true,integer: true},
			area_id:{required: true,integer: true},
			environment_id:{required: true,integer: true},
			comment:{required: true},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/lista/edit_local'),
				method: 'post',
				dataType: 'json',
				data: $('#formEditLocal').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else if(data.dados == 'ok') {
						lista_table.ajax.reload( null, false );
						$('#modalVerLocal').modal('hide');
						toastr.success('Edição realizada com sucesso', "Sucesso");
					}
				},
				beforeSend: function(){
					$('#btn_edit_local').prop("disabled",true).html('<i class="fa fa-spin fa-spinner"></i> Salvar');
				},
				complete: function(){
					$('#btn_edit_local').prop("disabled",false).html("Salvar");
				},
			}); // Fim do Ajax
		},
	}); // Fim da Validação

	$( "#formEditProblema" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			type_problems_id:{required: true,integer: true},
			comment:{required: true},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/lista/edit_problema'),
				method: 'post',
				dataType: 'json',
				data: $('#formEditProblema').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else if(data.dados == 'ok') {
						lista_table.ajax.reload( null, false );
						$('#modalVerProblema').modal('hide');
						toastr.success('Edição realizada com sucesso', "Sucesso");
					}
				},
				beforeSend: function(){
					$('#btn_edit_problema').prop("disabled",true).html('<i class="fa fa-spin fa-spinner"></i> Salvar');
				},
				complete: function(){
					$('#btn_edit_problema').prop("disabled",false).html("Salvar");
				},
			}); // Fim do Ajax
		},
	}); // Fim da Validação

	$( "#formEditStatus" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			status_id:{required: true,integer: true},
			comment:{required: true},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/lista/edit_status'),
				method: 'post',
				dataType: 'json',
				data: $('#formEditStatus').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else if(data.dados == 'ok') {
						lista_table.ajax.reload( null, false );
						$('#modalVerStatus').modal('hide');
						toastr.success('Edição realizada com sucesso', "Sucesso");
					}
				},
				beforeSend: function(){
					$('#btn_edit_status').prop("disabled",true).html('<i class="fa fa-spin fa-spinner"></i> Salvar');
				},
				complete: function(){
					$('#btn_edit_status').prop("disabled",false).html("Salvar");
				},
			}); // Fim do Ajax
		},
	}); // Fim da Validação
});