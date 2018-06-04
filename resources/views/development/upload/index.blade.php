@extends('layouts.base')
@section('title', 'Upload')

@section('content')

<div class="m-portlet m-portlet--mobile">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<h3 class="m-portlet__head-text">
					Upload
				</h3>
			</div>
		</div>
	</div>
	<div class="m-portlet__body">
		<div class="m-form m-form--label-align-right m--margin-top-10 m--margin-bottom-0">
			{{ csrf_field() }}
			<div class="row align-items-center">
				<div class="col-md-3">
					<div class="file">
						<p></p>
						<input name="filesToUpload[]" id="filesToUpload" type="file" multiple accept=".xlsx" />
					</div>
				</div>
				<div class="col-md-3">
					<div class="comands ">
						<button  onclick="return uploadAll();" style="padding: 0.5rem 1.25rem;margin-bottom: 14px;" type="submit" class="btn btn-success m--hide" id="btn_upload_all" name="btn_upload_all">Upload de Todos</button>
					</div>
				</div>
			</div>
		</div>
		<!--end: Search Form -->

		<div class="m_datatable" id="local_data"></div>
	</div>
</div>

<!--begin::Modal Exists-->
<div class="modal fade" id="modal_exists" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					Duplicado
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						&times;
					</span>
				</button>
			</div>
			<div class="modal-body">
				<p>
					O arquivo já foi selecionado anteriormente.<br>
					Por favor selecione outro arquivo.
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>
<!--end::Modal-->

@endsection
@section('scripts')
<script lang="javascript" src="<?php echo asset('assets/js/xlsx.full.min.js') ?>"></script>
<script>
	var array_files = [];
	var array = [];
	var first = true;
	var datatable;

	var worksheet_is_not_correct_pattern = false;
	var worksheet_is_empty = false;
	var worksheet_sucess = false;

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$("#filesToUpload").change(function(){
		var input = document.getElementById('filesToUpload');

		for (var i = 0; i < input.files.length; i++) {
			if(input.files[i].type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){

				var file_already_exists = false;
				array.forEach(function (item) {
					if(item.name == input.files[i].name){
						file_already_exists = true;
					}
				})

				if(file_already_exists){
					$("#modal_exists").modal()
				}else{
					array_files.push(input.files[i]);
					array.push({
						id: array.length,
						name: input.files[i].name,
						state: 0,
						message: ''
					});

					if(first){
						createTable();
						first = false;
					}else{
						updateTable();
					}
					$('#btn_upload_all').removeClass('m--hide').show();
				}
			}
		}
		console.log(array);
		console.log(array_files);
	});

	function remove(position){
		array_files.splice(position,1);
		array.splice(position,1);

		array.forEach(function (item) {
			if(item.id != 0){
				item.id = item.id -1;
			}
		});

		if(array.length == 0){
			$('#btn_upload_all').addClass('m--hide').show();
			datatable.destroy();
			first = true;
		}else{
			updateTable();
		}

		console.log(array);
		console.log(array_files);
	}

	function blockPage(){
		mApp.blockPage({
			overlayColor: '#000000',
			type: 'loader',
			state: 'success',
			message: 'Por favor aguarde...'
		});
	}

	function send_data(dados_json, position){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url: "upload/upload",
			//url: "http://localhost:8080/student/upload",
			type: "POST",
            //contentType: "application/json",
			dataType: "JSON",
			data: {'data': dados_json},
			success: function (result) {
				array[position].message = "Sucesso ao fazer upload.";
				array[position].state = 2;
				updateTable();
				console.log("Sucesso ao fazer upload!");
				console.log(result);
				mApp.unblockPage();
			},
			error: function (result) {
				array[position].message = "Arquivo fora do padrão.";
				array[position].state = 1;
				updateTable();
				console.log("Erro ao fazer upload!");
				console.log(result);
				mApp.unblockPage();
			}
		});
	}

	function upload(position){
		try {
			var rABS = true;
			var f = array_files[position];

			var reader = new FileReader();
			reader.onload = function(e) {
				var data = e.target.result;
				if(!rABS) data = new Uint8Array(data);

				var workbook = XLSX.read(data, {
					type: rABS ? 'binary' : 'array',
					cellDates: true,
					dateNF:"yyyy-mm-dd"});

				var worksheets = [];
				for (var i = 0; i < workbook.SheetNames.length; ++i) {
					var worksheet = workbook.Sheets[workbook.SheetNames[i]];
					var cell = worksheet[XLSX.utils.encode_cell({c: 0, r: 0})];

					if(cell == undefined){
						worksheet_is_empty = true;
						console.log("Arquivo em branco!");
					}else if(cell.v != "Câmpus"){
						worksheet_is_not_correct_pattern = true;
						console.log("Planilha fora dos padrões!");
					}else{
						worksheet_sucess = true;
						var dados_json = XLSX.utils.sheet_to_json(worksheet,{'date_format':'yyyy-mm-dd'});
						worksheets.push(dados_json);
					}
				}

				if(worksheets.length){
					worksheets.forEach(function (item) {
                        send_data(item, position);
					});
				}else{
					if(worksheet_is_empty && !worksheet_is_not_correct_pattern){
						array[position].message = "Arquivo em branco.";
						array[position].state = 1;
						updateTable();
						mApp.unblockPage();
					}else{
						array[position].message = "Arquivo fora do padrão.";
						array[position].state = 1;
						updateTable();
						mApp.unblockPage();
					}
				}
			};
			if(rABS) reader.readAsBinaryString(f); else reader.readAsArrayBuffer(f);
		}catch(err) {
			array[position].state = 1;
			updateTable();
			console.log(err.message);
		}
	}

	function updateTable(){
		datatable.destroy();
		createTable();
	}

	function uploadAll(){
		try{
			array.forEach(function (item) {
				if(item.state == 0){
					setTimeout(function() {
						uploadOne(item.id);
					}, 300);
				}
			});
		}catch(err) {
			console.log(err.message);
		}
	}

	function uploadOne(position){
		blockPage();
		upload(position);
	}

	function createTable(){
		datatable = $('.m_datatable').mDatatable({
			data: {
				type: 'local',
				source: array,
				pageSize: 10,
				saveState: {
					cookie: false,
					webstorage: false
				},
			},
			layout: {
				theme: 'default',
				class: '',
				scroll: false,
				height: 450,
				footer: false
			},
			sortable: true,
			filterable: false,
			pagination: true,
			columns: [{
				field: "id",
				title: "#",
				width: 40,
				selector: false,
				textAlign: 'center',
				sortable: 'asc'
			}, {
				field: "name",
				title: "Nome",
				width: 250,
			},{
				field: "state",
				title: "Status",
				filterable: false,
				width: 100,
				// callback function support for column rendering
				template: function (row) {
					var status = {
						0: {
							'title': 'Aguardando',
							'class': 'm-badge--info '
						},
						1: {
							'title': 'Erro',
							'class': ' m-badge--danger'
						},
						2: {
							'title': 'Sucesso',
							'class': ' m-badge--success'
						},
						5: {
							'title': 'Info',
							'class': ' m-badge--info'
						},
						6: {
							'title': 'Danger',
							'class': ' m-badge--danger'
						},
						7: {
							'title': 'Warning',
							'class': ' m-badge--warning'
						}
					};
					return '<span class="m-badge ' + status[row.state].class + ' m-badge--wide">' + status[row.state].title + '</span>';
				}
			}, {
				field: "message",
				title: "",
				width: 200,
			}, {
				field: "Ações",
				width: 100,
				title: "Ações",
				sortable: false,
				filterable: false,
				overflow: 'visible',
				template: function (row) {
					if(row.state == 2){
						return '-';
					}else{
						return '\
							<a onclick="return uploadOne(' + row.id + ');" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Enviar">\
								<i class="la la-upload"></i>\
							</a>\
							<a onclick="return remove(' + row.id + ');" data-toggle="modal" data-target="#m_modal_1" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Deletar">\
								<i class="la la-remove"></i>\
							</a>\
						';
					}
				}
			}]
		});
	}
</script>

@endsection
