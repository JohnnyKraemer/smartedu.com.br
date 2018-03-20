@extends('layouts.admin') @section('title', 'Curso') @section('content')

<div class="m-portlet m-portlet--mobile">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<h3 class="m-portlet__head-text">
					Cursos
				</h3>
			</div>
		</div>
	</div>
	<div class="m-portlet__body">
		<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-15">
			<div class="row align-items-center">
				<div class="col-xl-12 order-2 order-xl-1">
					<div class="form-group m-form__group row align-items-center">
						<div class="col-md-4">
							<div class="m-input-icon m-input-icon--left">
								<input type="text" class="form-control m-input m-input--solid" placeholder="Pesquisa..." id="m_form_search">
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-search"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="m-form__group m-form__group--inline">
								<div class="m-form__label">
									<label>Campus:</label>
								</div>
								<div class="m-form__control">
									<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_campus">
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
						<div class="col-md-4">
							<div class="m-form__group m-form__group--inline">
								<div class="m-form__label">
									<label>Status:</label>
								</div>
								<div class="m-form__control">
									<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_funcionamento">
										<option value="">Todos</option>
										<option value="Em Atividade">Em Atividade</option>
										<option value="Em Extinção">Em Extinção</option>
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
		var objects = JSON.parse(document.getElementById("objects").value);

		var datatable = $('.m_datatable').mDatatable({
			data: {
				type: 'local',
				source: objects,
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
				width: 20,
				selector: false,
				textAlign: 'center',
				sortable: 'asc',
				responsive: {
					visible: 'md',
  					hidden: 'lg'
				}
			}, {
				field: "name",
				title: "Nome",
				width: 200,
			},{
				field: "grau",
				title: "Grau",
				responsive: {
					visible: 'md',
  					hidden: 'lg'
				}
			},{
				field: "turno",
				title: "Turno",
				responsive: {
					visible: 'md',
  					hidden: 'lg'
				}
			},{
				field: "funcionamento",
				title: "Status",
			}]
		});

		var query = datatable.getDataSourceQuery();

		$('#m_form_search').on('keyup', function (e) {
			datatable.search($(this).val().toLowerCase());
		}).val(query.generalSearch);

		$('#m_form_funcionamento').on('change', function () {
			datatable.search($(this).val(), 'funcionamento');
		}).val(typeof query.funcionamento !== 'undefined' ? query.funcionamento : '');

		$('#m_form_campus').on('change', function () {
			datatable.search($(this).val(), 'campus_id');
		}).val(typeof query.campus_id !== 'undefined' ? query.campus_id : '');

		$('#m_form_funcionamento').selectpicker();
		$('#m_form_campus').selectpicker();
	});
</script>
@endsection
