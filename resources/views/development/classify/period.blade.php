@extends('layouts.admin')
@section('title', 'Classicação por Período')

@section('content')
<div class="m-portlet m-portlet--mobile">
  <div class="m-portlet__head">
    <div class="m-portlet__head-caption">
      <div class="m-portlet__head-title">
        <h3 class="m-portlet__head-text">
          Classicação por Período
        </h3>
      </div>
    </div>
  </div>
  <div class="m-portlet__body">
    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-15">
      <div class="row align-items-center">
        <div class="col-xl-12 order-2 order-xl-1">
          <div class="form-group m-form__group row align-items-center">
            <div class="col-md-2">
              <div class="m-form__group m-form__group--inline">
                <div class="m-form__label">
                  <label>Período:</label>
                </div>
                <div class="m-form__control">
                  <select id="m_form_period" class="form-control m-bootstrap-select m-bootstrap-select--solid">
                    <option value="">Todos</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
                </div>
              </div>
              <div class="d-md-none m--margin-bottom-10"></div>
            </div>
            <div class="col-md-3">
							<div class="m-form__group m-form__group--inline">
								<div class="m-form__label">
									<label>Classificador:</label>
								</div>
								<div class="m-form__control">
									<select id="m_form_classifier" class="form-control m-bootstrap-select m-bootstrap-select--solid">
										<option value="">Todos</option>
										@foreach($classifiers as $classifier)
											<option value="{{$classifier->id}}">
												{{$classifier->name}}
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
                  <label>Variável:</label>
                </div>
                <div class="m-form__control">
                  <select id="m_form_variable" class="form-control m-bootstrap-select m-bootstrap-select--solid">
                    <option value="">Todos</option>
                    @foreach($variables as $variable)
                      <option value="{{$variable->name}}">
                        {{$variable->name}}
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
                  <label>Curso:</label>
                </div>
                <div class="m-form__control">
                  <select id="m_form_course" class="form-control m-bootstrap-select m-bootstrap-select--solid">
                    <option value="">Todos</option>
                    @foreach($courses as $course)
                    <option value="{{$course->id}}">
                      {{$course->name}}
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
@endsection
@section('scripts')
<script>
$( document ).ready(function() {
  var objects = JSON.parse(document.getElementById("objects").value);

  console.log(objects);

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
      width: 40,
      selector: false,
      textAlign: 'center',
      //sortable: 'asc',
      responsive: {
        visible: 'md',
        hidden: 'lg'
      }
    }, {
      field: "period",
      title: "Período",
      width: 60,
    },{
      field: "classifier_name",
      title: "Classificador",
      width: 200,
    },{
      field: "variables_name",
      title: "Variáveis",
      width: 200
    },{
      field: "success_percent",
      title: "Sucesso",
      responsive: {
        visible: 'md',
        hidden: 'lg'
      },
      template: function (row) {
        return parseFloat(row.success_percent).toFixed(2)+"%";
      }
    }]
  });

  var query = datatable.getDataSourceQuery();



  $('#m_form_period').on('change', function () {
    datatable.search($(this).val(), 'period');
  }).val(typeof query.period !== 'undefined' ? query.period : '');

  $('#m_form_course').on('change', function () {
    datatable.search($(this).val(), 'course_id');
  }).val(typeof query.course_id !== 'undefined' ? query.course_id : '');

  $('#m_form_classifier').on('change', function () {
    datatable.search($(this).val(), 'classifier_id');
  }).val(typeof query.classifier_id !== 'undefined' ? query.classifier_id : '');

  $('#m_form_variable').on('change', function () {
    datatable.search($(this).val(), 'variables_name');
  }).val(typeof query.variables_name !== 'undefined' ? query.variables_name : '');

  $('#m_form_period').selectpicker();
  $('#m_form_course').selectpicker();
  $('#m_form_classifier').selectpicker();
  $('#m_form_variable').selectpicker();
});
</script>
@endsection
