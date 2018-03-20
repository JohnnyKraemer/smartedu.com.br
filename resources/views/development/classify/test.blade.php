@extends('layouts.admin') @section('title', 'Classificadores') @section('content')
<input type="hidden" id="classifiers" name="classifiers" value="{{$classifiers}}">
<input type="hidden" id="variables" name="variables" value="{{$variables}}">
<input type="hidden" id="courses" name="courses" value="{{$courses}}">

<div class="row">
  <div class="col-lg-4">
    <!--begin::Portlet-->
    <div class="m-portlet">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
              Classificação
            </h3>
          </div>
        </div>
        <div class="m-portlet__head-tools">
          <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
              <a href="#" class="m-portlet__nav-link btn btn-success m-btn m-btn--pill m-btn--air" id="btn_classify" name="btn_classify">
                Classificar
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="m-portlet__body">
        <ul class="nav nav-tabs  m-tabs-line" role="tablist">
          <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_tabs_6_1" role="tab" aria-expanded="true">
              Classificador
            </a>
          </li>
          <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_6_2" role="tab" aria-expanded="false">
              Variáveis
            </a>
          </li>
          <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_courses" role="tab" aria-expanded="false">
              Cursos
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="m_tabs_6_1" role="tabpanel" aria-expanded="true">
            <div class="m_datatable_classifiers" id="local_data"></div>
          </div>
          <div class="tab-pane" id="m_tabs_6_2" role="tabpanel">
            <div class="m_datatable_variables" id="local_data_variables"></div>
          </div>
          <div class="tab-pane" id="m_tabs_courses" role="tabpanel" aria-expanded="false">
            <div class="m_datatable_courses" id="local_data_courses"></div>
          </div>
        </div>
      </div>
    </div>
    <!--end::Portlet-->
  </div>
  <div class="col-lg-8">
    <div class="m-portlet m-portlet--mobile">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
              Classicação Geral
            </h3>
          </div>
        </div>
      </div>
      <div class="m-portlet__body">
        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-15">
          <div class="row align-items-center">
            <div class="col-xl-12 order-2 order-xl-1">
              <div class="form-group m-form__group row align-items-center">
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
  </div>

</div>
@endsection
@section('scripts')
<script>
var classifiers;
var variables;
var courses;
var objects;
var datatable_classifiers;
var datatable_variables;
var datatable_courses;
var classifiers_send = [];
var variables_send = [];
var courses_send = [];

$( "#btn_classify_all" ).click(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "http://localhost:8080/classify/all",
    type: "POST",
    crossDomain: true,
    success: function (result) {
      console.log("Sucesso ao fazer upload!");
      console.log(result);
      //mApp.unblockPage();
    },
    error: function (result) {
      console.log("Erro ao fazer upload!");
      console.log(result);
      //mApp.unblockPage();
    }
  });
});

function send_data(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "classify/new",
    type: "POST",
    dataType: "JSON",
    data: {'classifiers': classifiers_send,
    'variables': variables_send,
    'courses': courses_send},
    success: function (result) {
      console.log("Sucesso ao fazer upload!");
      console.log(result);
      //mApp.unblockPage();
    },
    error: function (result) {
      console.log("Erro ao fazer upload!");
      console.log(result);
      //mApp.unblockPage();
    }
  });
}


$( "#btn_classify" ).click(function() {
  for(var i = 0; i< datatable_classifiers.setSelectedRecords().getSelectedRecords().length; i++){
    var p = datatable_classifiers.setSelectedRecords().getSelectedRecords()[i].dataset.row;
    classifiers_send[i] = classifiers[p];
  }

  for(var i = 0; i< datatable_variables.setSelectedRecords().getSelectedRecords().length; i++){
    var p = datatable_variables.setSelectedRecords().getSelectedRecords()[i].dataset.row;
    variables_send[i] = variables[p];
  }

  for(var i = 0; i< datatable_courses.setSelectedRecords().getSelectedRecords().length; i++){
    var p = datatable_courses.setSelectedRecords().getSelectedRecords()[i].dataset.row;
    courses_send[i] = courses[p];
  }

  console.log(classifiers_send);
  console.log(variables_send);
  console.log(courses_send);
  send_data();
});

$( document ).ready(function() {
  classifiers = JSON.parse(document.getElementById("classifiers").value);
  variables = JSON.parse(document.getElementById("variables").value);
  courses = JSON.parse(document.getElementById("courses").value);
  objects = JSON.parse(document.getElementById("objects").value);

  datatable_classifiers = $('.m_datatable_classifiers').mDatatable({
    data: {
      type: 'local',
      source: classifiers,
      pageSize: 10,
      saveState: {
        cookie: false,
        webstorage: false
      },
    },
    layout: {
      theme: 'default',
      class: '',
      scroll: true,
      height: 450,
      footer: false
    },
    sortable: true,
    filterable: false,
    pagination: false,
    columns: [{
      field: "RecordID",
      title: "#",
      sortable: false, // disable sort for this column
      width: 10,
      textAlign: 'center',
      selector: {class: 'm-checkbox--solid m-checkbox--brand'}
    },{
      field: "name",
      title: "Todos",
      width: 250,
    }]
  });

  datatable_variables = $('.m_datatable_variables').mDatatable({
    data: {
      type: 'local',
      source: variables,
      pageSize: 10,
      saveState: {
        cookie: false,
        webstorage: false
      },
    },
    layout: {
      theme: 'default',
      class: '',
      scroll: true,
      height: 450,
      footer: false
    },
    sortable: true,
    filterable: false,
    pagination: false,
    columns: [{
      field: "RecordID",
      title: "#",
      sortable: false, // disable sort for this column
      width: 10,
      textAlign: 'center',
      selector: {class: 'm-checkbox--solid m-checkbox--brand'}
    },{
      field: "name",
      title: "Todos",
      width: 250,
    }]
  });

  // ----------------------------------------------------------- COURSES
  datatable_courses = $('.m_datatable_courses').mDatatable({
    data: {
      type: 'local',
      source: courses,
      pageSize: 10,
      saveState: {
        cookie: false,
        webstorage: false
      },
    },
    layout: {
      theme: 'default',
      class: '',
      scroll: true,
      height: 450,
      footer: false
    },
    sortable: true,
    filterable: false,
    pagination: false,
    columns: [{
      field: "RecordID",
      title: "#",
      sortable: false, // disable sort for this column
      width: 10,
      textAlign: 'center',
      selector: {class: 'm-checkbox--solid m-checkbox--brand'}
    },{
      field: "name",
      title: "Todos",
      width: 250,
    }]
  });

  datatable_objects = $('.m_datatable').mDatatable({
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

  var query = datatable_objects.getDataSourceQuery();

  $('#m_form_course').on('change', function () {
    datatable.search($(this).val(), 'course_id');
  }).val(typeof query.course_id !== 'undefined' ? query.course_id : '');

  $('#m_form_classifier').on('change', function () {
    datatable.search($(this).val(), 'classifier_id');
  }).val(typeof query.classifier_id !== 'undefined' ? query.classifier_id : '');

  $('#m_form_variable').on('change', function () {
    datatable.search($(this).val(), 'variables_name');
  }).val(typeof query.variables_name !== 'undefined' ? query.variables_name : '');

  $('#m_form_course').selectpicker();
  $('#m_form_classifier').selectpicker();
  $('#m_form_variable').selectpicker();
});
</script>
@endsection
