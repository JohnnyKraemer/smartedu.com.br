@extends('layouts.admin') @section('title', 'Usuários') @section('content')

<div class="m-portlet m-portlet--mobile">
	<div class="m-portlet__head">
		<div class="row align-items-center" style="margin-top: 15px;">
			<div class="col-md-9">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Usuários
						</h3>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<a href="{{ URL::to('admin/user/create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
					<span>
						<i class="la la-cart-plus"></i>
						<span>Novo Usuário</span>
					</span>
				</a>
			</div>
		</div>
	</div>
	<div class="m-portlet__body">
		<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-15">
			<div class="row align-items-center">
				<div class="col-xl-12 order-2 order-xl-1">
					<div class="form-group m-form__group row align-items-center">
						<div class="col-md-3">
							<div class="m-input-icon m-input-icon--left">
								<input type="text" class="form-control m-input m-input--solid" placeholder="Pesquisa..." id="m_form_search">
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-search"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="col-md-3">
							<div class="m-form__group m-form__group--inline">
								<div class="m-form__label">
									<label>Status:</label>
								</div>
								<div class="m-form__control">
									<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_status_user">
										<option value="">Todos</option>
										<option value="1">Ativo</option>
										<option value="2">Desativo</option>
									</select>
								</div>
							</div>
							<div class="d-md-none m--margin-bottom-10"></div>
						</div>
						<div class="col-md-3">
							<div class="m-form__group m-form__group--inline">
								<div class="m-form__label">
									<label>Cargo:</label>
								</div>
								<div class="m-form__control">
									<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_position_user">
										<option value="">Todos</option>
										@foreach($positions as $position)
											<option value="{{$position->id}}">
												{{$position->name}}
											</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="d-md-none m--margin-bottom-10"></div>
						</div>
						<div class="col-md-3">
							<div class="m-form__group m-form__group--inline">
								<div class="m-form__label">
									<label>Campus:</label>
								</div>
								<div class="m-form__control">
									<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_campus_user">
										<option value="">Todos</option>
										@foreach($campus as $campu)
											<option value="{{$campu->id}}">
												{{$campu->name}}
											</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="d-md-none m--margin-bottom-10"></div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!--end: Search Form -->

		<!--begin: Datatable -->
		<div class="m_datatable" id="local_data"></div>
		<input type="hidden" id="objects" name="objects" value="{{$objects}}">
		<!--end: Datatable -->
	</div>
</div>


<!--begin::Modal-->
<div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					Deletar
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						&times;
					</span>
				</button>
			</div>
			<div class="modal-body">
				<p>
					Tem certeza que deseja deletar este registro?
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<form id="form_delete" name="form_delete" action="{{url('admin/user', [0])}}" method="POST">
					<input type="hidden" name="_method" value="DELETE">
					<input type="hidden" id="var_delete" name="var_delete" value="0">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="submit" class="btn btn-danger" value="Deletar" />
				</form>
			</div>
		</div>
	</div>
</div>
<!--end::Modal-->

@endsection @section('scripts')
<script>
	function alterDelete(id) {
		document.getElementById("var_delete").value = id;
	}

	$( document ).ready(function() {
		var objects = document.getElementById("objects").value;
		var dataJSONArray = JSON.parse(objects);

		console.log(dataJSONArray);

		var datatable = $('.m_datatable').mDatatable({
			// datasource definition
			data: {
				type: 'local',
				source: dataJSONArray,
				pageSize: 5,
				saveState: {
					cookie: false,
					webstorage: false
				},
			},

			// layout definition
			layout: {
				theme: 'default', // datatable theme
				class: '', // custom wrapper class
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				height: 450, // datatable's body's fixed height
				footer: false // display/hide footer
			},
			cookie: false,
			// column sorting(refer to Kendo UI)
			sortable: true,

			// column based filtering(refer to Kendo UI)
			filterable: false,

			pagination: true,

			// inline and bactch editing(cooming soon)
			// editable: false,

			// columns definition
			columns: [{
				field: "id",
				title: "#",
				width: 20,
				//sortable: false,
				selector: false,
				textAlign: 'center'
			}, {
				field: "name",
				title: "Nome",
				sortable: 'asc',
				width: 200,
			}, {
				field: "campus",
				title: "Campus",
				filterable: false,
				responsive: {
					visible: 'lg'
				},
				template: function (row) {
					if(row.campus == null){
						return "-";
					}else{
						return row.campus.name;
					}
				}
			},{
				field: "position",
				title: "Cargo",
				filterable: false,
				width: 200,
				responsive: {
					visible: 'lg'
				},
				template: function (row) {
					if(row.position == null){
						return "Sem Cargo";
					}else{
						return row.position.name;
					}
				}
			},{
				field: "status",
				title: "Status",
				filterable: false,
				// callback function support for column rendering
				template: function (row) {
					var status = {
						1: {
							'title': 'Ativo',
							'class': 'm-badge--success'
						},
						2: {
							'title': 'Desativo',
							'class': ' m-badge--danger'
						},
						3: {
							'title': 'Canceled',
							'class': ' m-badge--primary'
						},
						4: {
							'title': 'Success',
							'class': ' m-badge--brand'
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
					return '<span class="m-badge ' + status[row.status].class + ' m-badge--wide">' + status[row.status].title + '</span>';
				}
			}, {
				field: "Ações",
				width: 70,
				title: "Ações",
				sortable: false,
				filterable: false,
				overflow: 'visible',
				template: function (row) {
					var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

					return '\
						<a href="user/' + row.id + '/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Editar">\
                            <i class="la la-edit"></i>\
                        </a>\
						<a onclick="return alterDelete(' + row.id + ');" data-toggle="modal" data-target="#m_modal_1" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Deletar">\
                            <i class="la la-remove"></i>\
                        </a>\
					';
				}
			}]
		});

		var query = datatable.getDataSourceQuery();

		//console.log(datatable);

		$('#m_form_search').on('keyup', function (e) {
			datatable.search($(this).val().toLowerCase());
		}).val(query.generalSearch);

		$('#m_form_status_user').on('change', function () {
			datatable.search($(this).val(), 'status');
		}).val(typeof query.status !== 'undefined' ? query.status : '');

		$('#m_form_position_user').on('change', function () {
			datatable.search($(this).val(), 'position_id');
		}).val(typeof query.position_id !== 'undefined' ? query.position_id : '');

		$('#m_form_campus_user').on('change', function () {
			datatable.search($(this).val(), 'campus_id');
		}).val(typeof query.campus_id !== 'undefined' ? query.campus_id : '');

		$('#m_form_status_user').selectpicker();
		$('#m_form_position_user').selectpicker();
		$('#m_form_campus_user').selectpicker();

	});
</script>
@endsection
