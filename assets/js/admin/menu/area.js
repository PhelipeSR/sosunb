function resset_form(seletor){
	$(seletor).validate().resetForm();
	$(seletor)[0].reset();
	$('.form-control').removeClass( "is-valid is-invalid focused");
}

$(document).ready(function() {

	var area_table = $('#area_table').DataTable({
		dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>B"+"<'row'<'col-sm-12'tr>>"+"<'row'<'col-sm-5'i><'col-sm-7'p>>",
		ajax: { url: base_url('admin/menu/area/get_area'), type: "post"},
		language: { url: base_url('assets/plugins/datatables/translation.json')},
		processing: true, // Ativa gif de processamento
		serverSide: true, // ativa o processamento no lado do servidor
		responsive: true, // Deixa a tabela responsiva
		order: [[ 0, "desc" ]], // Ordena por ID de forma decrescente

		columns: [
			{ data: "id"   },
			{ data: "area" },
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
					resset_form('#formAddArea');
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
			url: base_url('admin/menu/area/delete_area'),
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
					area_table.ajax.reload( null, false );
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
		resset_form('#formEditArea');
		var row = area_table.row( $('[data-row="'+$(this).data('btn')+'"]') ).data();
		$('#id').val(row.id);
		$("#area_edit").val(row.area);
		$('#modalEdit').modal('show');
	});

	/* =====================================================================
	*  CRUD
	*  ===================================================================== */

	$( "#formAddArea" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			area:   {required: true,maxlength: 50},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/area/create_area'),
				method: 'post',
				dataType: 'json',
				data: $('#formAddArea').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else if(data.dados == 'ok') {
						area_table.ajax.reload( null, false );
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

	$( "#formEditArea" ).validate( {
		errorClass: 'invalid-feedback',
		rules: {
			area:   {required: true,maxlength: 50},
		},
		highlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
		},
		submitHandler: function (form) {
			$.ajax({
				url: base_url('admin/menu/area/update_area'),
				method: 'post',
				dataType: 'json',
				data: $('#formEditArea').serialize(),
				success: function(data, textStatus, jqXHR) {
					if (data.erro) {
						toastr.error(data.msg_erro, "Falha");
					}else if(data.dados == 'ok') {
						area_table.ajax.reload( null, false );
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