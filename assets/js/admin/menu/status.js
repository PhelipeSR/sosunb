function resset_form(seletor){
	$(seletor).validate().resetForm();
	$(seletor)[0].reset();
	$('.form-control').removeClass( "is-valid is-invalid focused");
}

$(document).ready(function() {

	var status_table = $('#status_table').DataTable({
		dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>B"+"<'row'<'col-sm-12'tr>>"+"<'row'<'col-sm-5'i><'col-sm-7'p>>",
		ajax: { url: base_url('admin/menu/status/get_status'), type: "post"},
		language: { url: base_url('assets/plugins/datatables/translation.json')},
		processing: true, // Ativa gif de processamento
		serverSide: true, // ativa o processamento no lado do servidor
		responsive: true, // Deixa a tabela responsiva
		order: [[ 0, "desc" ]], // Ordena por ID de forma decrescente

		columns: [
			{ data: "id"   },
			{ data: "name" },
			{ data: "id", render: function(value, type, row, meta) {
				if (row.excluded == 0) {
					return "<div class='btn-group'><button title='Editar' class='btn btn-info editar' data-btn='"+value+"'><i class='fa fa-pencil'></i></button><button title='Visibilidade' class='btn btn-success excluir' data-excluded='1'  data-btn='"+value+"'><i class='fa fa-eye'></i></button></div>";
				}else{
					return "<div class='btn-group'><button title='Editar' class='btn btn-info editar' data-btn='"+value+"'><i class='fa fa-pencil'></i></button><button title='Visibilidade' class='btn btn-danger excluir' data-excluded='0'  data-btn='"+value+"'><i class='fa fa-eye-slash'></i></button></div>";
				}
			}},
		],
		buttons: [
			// {
			// 	className: 'btn btn-primary text-white',
			// 	text: '<span class="glyphicon glyphicon-edit"> Adicionar</span>',
			// 	action: function ( e, dt, type, indexes ) {
			// 		resset_form('#formAddStatus');
			// 		$('#modalAdd').modal('show');
			// 	}
			// },
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
				targets: [2],
				orderable: false,
				width: "10%",
			}
		],
	}); // Fim Datatables

	$(document).off('click', '.excluir').on('click', '.excluir', function(){
		id = $(this).data('btn');
		excluded = $(this).data('excluded');
		$.ajax({
			url: base_url('admin/menu/status/delete_status'),
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
					status_table.ajax.reload( null, false );
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
		resset_form('#formEditStatus');
		var row = status_table.row( $('[data-row="'+$(this).data('btn')+'"]') ).data();
		$('#id').val(row.id);
		$("#name_edit").val(row.name);
		$('#modalEdit').modal('show');
	});

	/* =====================================================================
	*  CRUD
	*  ===================================================================== */

	$( "#formAddStatus" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			name:   {required: true,maxlength: 50},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/status/create_status'),
				method: 'post',
				dataType: 'json',
				data: $('#formAddStatus').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else if(data.dados == 'ok') {
						status_table.ajax.reload( null, false );
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

	$( "#formEditStatus" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			name:   {required: true,maxlength: 50},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/status/update_status'),
				method: 'post',
				dataType: 'json',
				data: $('#formEditStatus').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else if(data.dados == 'ok') {
						status_table.ajax.reload( null, false );
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