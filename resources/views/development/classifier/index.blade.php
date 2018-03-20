@extends('layouts.admin') @section('title', 'Classificadores') @section('content')

<div class="m-portlet m-portlet--mobile">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<h3 class="m-portlet__head-text">
					Classificadores
				</h3>
			</div>
		</div>
	</div>
	<div class="m-portlet__body">
		<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-15">
			<div class="row align-items-center">
				<div class="col-xl-12 order-2 order-xl-1">
					<div class="form-group m-form__group row align-items-center">
						<div class="col-md-6">
							<div class="m-input-icon m-input-icon--left">
								<input type="text" class="form-control m-input m-input--solid" placeholder="Pesquisa..." id="m_form_search">
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-search"></i>
									</span>
								</span>
							</div>
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
@endsection
@section('scripts')
<script>
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
				width: 300,
			},{
				field: "pattern",
				title: "Padrão",
				template: function (row) {
					var pattern = {
						0: {
							'title': 'Não',
							'class': 'm-badge--info'
						},
						1: {
							'title': 'Sim',
							'class': ' m-badge--success'
						}
					};
					return '<span class="m-badge ' + pattern[row.pattern].class + ' m-badge--wide">' + pattern[row.pattern].title + '</span>';
				}
			},{
				field: "use_classify",
				title: "Classificar",
				template: function (row) {
					if(row.use_classify == 1){
						return '<label class="m-checkbox" style="margin-bottom: 15px;"><input onchange="alterState(\'classifier/use_classify\','+ row.id + ')"  type="checkbox" checked="checked"><span></span></label>';
					}else{
						return '<label class="m-checkbox" style="margin-bottom: 15px;"><input onchange="alterState(\'classifier/use_classify\','+ row.id + ')"  type="checkbox" ><span></span></label>';
					}
				}
			}]
		});

		var query = datatable.getDataSourceQuery();

		$('#m_form_search').on('keyup', function (e) {
			datatable.search($(this).val().toLowerCase());
		}).val(query.generalSearch);

	});
</script>
@endsection
