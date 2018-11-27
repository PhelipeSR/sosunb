function resset_form(seletor){
	$(seletor).validate().resetForm();
	$(seletor)[0].reset();
	$('.form-control').removeClass( "is-valid is-invalid focused");
}

$(document).ready(function() {

	// var lista_table_exclude = $('#lista_table_exclude').DataTable({
	// 	dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>B"+"<'row'<'col-sm-12'tr>>"+"<'row'<'col-sm-5'i><'col-sm-7'p>>",
	// 	ajax: { url: base_url('admin/menu/lista/get_lista_exclude'), type: "post"},
	// 	language: { url: base_url('assets/plugins/datatables/translation.json')},
	// 	processing: true, // Ativa gif de processamento
	// 	serverSide: true, // ativa o processamento no lado do servidor
	// 	responsive: true, // Deixa a tabela responsiva
	// 	order: [[ 0, "desc" ]], // Ordena por ID de forma decrescente

	// 	columns: [
	// 		{ data: "id"            },
	// 		{ data: "image_profile", render: function(value, type, row, meta){
	// 			return "<div class='text-center'><img width='50px' class='img-fluid' src='"+base_url('uploads/perfil/'+value)+"'></div>";
	// 		}},
	// 		{ data: "name"          },
	// 		{ data: "email"         },
	// 		{ data: "registry"      },
	// 		{ data: "identity"      },
	// 		{ data: "date_birth"    },
	// 		{ data: "register_date" },
	// 		{ data: "type"          },
	// 		{ data: "date_excluded" },
	// 	],
	// 	buttons: [
	// 		'colvis',
	// 	],
	// 	columnDefs: [
	// 		{
	// 			targets: [0,5,6],
	// 			visible: false
	// 		},
	// 		{
	// 			targets: [1],
	// 			orderable: false,
	// 			width: "10%",
	// 		}
	// 	],
	// }); // Fim Datatables

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
			{ data: "image_profile", render: function(value, type, row, meta){
				return "<div class='text-center'><img width='50px' class='img-fluid' src='"+base_url('uploads/perfil/'+value)+"'></div>";
			}},
			{ data: "name"          },
			{ data: "email"         },
			{ data: "registry"      },
			{ data: "identity"      },
			{ data: "date_birth"    },
			{ data: "register_date" },
			{ data: "type" },
			{ data: "id", render: function(value, type, row, meta) {
				if (row.excluded == 0) {
					return "<div class='btn-group'><button title='Editar' class='btn btn-info editar' data-btn='"+value+"'><i class='fa fa-pencil'></i></button><button title='Visibilidade' class='btn btn-success excluir' data-excluded='1'  data-btn='"+value+"'><i class='fa fa-eye'></i></button></div>";
				}else{
					return "<div class='btn-group'><button title='Editar' class='btn btn-info editar' data-btn='"+value+"'><i class='fa fa-pencil'></i></button><button title='Visibilidade' class='btn btn-danger excluir' data-excluded='0'  data-btn='"+value+"'><i class='fa fa-eye-slash'></i></button></div>";
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
				targets: [0,5,6],
				visible: false
			},
			{
				targets: [1,9],
				orderable: false,
				width: "10%",
			}
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

	$(document).off('click', '.editar').on('click', '.editar', function(){
		resset_form('#formEditUser');
		var row = lista_table.row( $('[data-row="'+$(this).data('btn')+'"]') ).data();
		$('#id').val(row.id);
		$("#name_edit").val(row.name);
		$("#email_edit").val(row.email);
		$("#profile_type_edit").val(row.profile_type_id);
		$("#identity_edit").val(row.identity);
		$("#registry_edit").val(row.registry);
		$("#date_birth_edit").val(row.date_birth_nf);
		$('#modalEdit').modal('show');
	});

	/* =====================================================================
	*  CRUD
	*  ===================================================================== */

	$( "#formAddUser" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			name:        {required: true,maxlength: 100},
			email:       {required: true,email: true,maxlength: 100},
			identity:    {required: true,integer: true,maxlength: 20},
			registry:    {required: true,integer: true,maxlength: 20},
			profile_type:{required: true,integer: true},
			date_birth:  {required: true,date: true},
			password:     {required: true,minlength: 6},
			conf_password: {required: true,equalTo: "#password_add"},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/lista/create_lista'),
				method: 'post',
				dataType: 'json',
				data: $('#formAddUser').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else if(data.dados == 'ok') {
						lista_table.ajax.reload( null, false );
						$('#modalAdd').modal('hide');
						toastr.success('Adição realizada com sucesso', "Sucesso");
					}
				},
				beforeSend: function(){
					$('#btn_add').prop("disabled",true).html('<i class="fa fa-spin fa-spinner"></i> Salvar');
				},
				complete: function(){
					$('#btn_add').prop("disabled",false).html("Salvar");
				},
			}); // Fim do Ajax
		},
	}); // Fim da Validação

	$( "#formEditUser" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			name:        {required: true,maxlength: 100},
			email:       {required: true,email: true,maxlength: 100},
			identity:    {required: true,integer: true,maxlength: 20},
			registry:    {required: true,integer: true,maxlength: 20},
			profile_type:{required: true,integer: true},
			date_birth:  {required: true,date: true},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/lista/update_lista'),
				method: 'post',
				dataType: 'json',
				data: $('#formEditUser').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else if(data.dados == 'ok') {
						lista_table.ajax.reload( null, false );
						$('#modalEdit').modal('hide');
						toastr.success('Edição realizada com sucesso', "Sucesso");
					}
				},
				beforeSend: function(){
					$('#btn_add').prop("disabled",true).html('<i class="fa fa-spin fa-spinner"></i> Salvar');
				},
				complete: function(){
					$('#btn_add').prop("disabled",false).html("Salvar");
				},
			}); // Fim do Ajax
		},
	}); // Fim da Validação
});