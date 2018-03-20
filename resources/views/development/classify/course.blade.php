@extends('layouts.admin')

<!---------------- Inicio Compomentes ---------------->
@component('layouts.aside.classify')
@endcomponent
<!---------------- Final de Compomentes ---------------->

@section('title', 'Classicação Geral')

@section('stylesheets')
@endsection

@section('content')

@section('aside')
@endsection

<div class="row">
  <div class="col-lg-5">
    <!--begin::Portlet-->
    <div class="m-portlet m-portlet--tab">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon m--hide">
              <i class="la la-gear"></i>
            </span>
            <h3 class="m-portlet__head-text">
              Classificadores com melhores resultados
            </h3>
          </div>
        </div>
      </div>
      <div class="m-portlet__body" style="padding: 0;">
        <div id="chart_abridged" style="height: 280px;"></div>
      </div>
    </div>
    <!--end::Portlet-->
  </div>
  <div class="col-lg-7">
    <!--begin::Portlet-->
    <div class="m-portlet m-portlet--tab">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon m--hide">
              <i class="la la-gear"></i>
            </span>
            <h3 class="m-portlet__head-text">
              Classificadores com melhores resultados
            </h3>
          </div>
        </div>
      </div>
      <div class="m-portlet__body" style="padding: 0;">
        <div id="chart_detail" style="height: 280px;"></div>
      </div>
    </div>
    <!--end::Portlet-->
  </div>
</div>


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
    <input type="hidden" id="grafic_one" name="grafic_one" value="{{$grafic_one}}">
    <!--end: Datatable -->
  </div>
</div>
@endsection
@section('scripts')


<script>
$( document ).ready(function() {
  var objects = JSON.parse(document.getElementById("objects").value);
  var test = JSON.parse(document.getElementById("grafic_one").value);

  console.log(objects);
  console.log(test);

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
      template: function (row) {
        return parseFloat(row.success_percent).toFixed(2)+"%";
      }
    },{
        field: "course_name",
        title: "Curso",
        width: 400
    }]
  });

  var query = datatable.getDataSourceQuery();

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

  var chart;
  var chart_detail;

  AmCharts.ready(function() {
    // SERIAL CHART
    chart = new AmCharts.AmSerialChart();
    chart.dataProvider = test;
    chart.categoryField = "classifier";

    // sometimes we need to set margins manually
    // autoMargins should be set to false in order chart to use custom margin values
    chart.autoMargins = false;
    chart.marginLeft = 0;
    chart.marginRight = 0;
    chart.marginTop = 30;
    chart.marginBottom = 40;

    // AXES
    // category
    var categoryAxis = chart.categoryAxis;
    categoryAxis.gridAlpha = 0;
    categoryAxis.axisAlpha = 0;
    categoryAxis.gridPosition = "start";

    // value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.stackType = "100%"; // this line makes the chart 100% stacked
    valueAxis.gridAlpha = 0;
    valueAxis.axisAlpha = 0;
    valueAxis.labelsEnabled = false;
    chart.addValueAxis(valueAxis);

    // GRAPHS
    // first graph
    var graph = new AmCharts.AmGraph();
    graph.title = "Sucesso";
    graph.labelText = "[[percents]]%";
    graph.balloonText = "Sucesso: [[success]] ([[percents]]%)";
    graph.valueField = "success";
    graph.type = "column";
    graph.lineAlpha = 0;
    graph.fillAlphas = 1;
    graph.lineColor = "#C72C95";
    chart.addGraph(graph);

    var graph = new AmCharts.AmGraph();
    graph.title = "Falha";
    graph.labelText = "[[percents]]%";
    graph.balloonText = "Falha: [[failure]] ([[percents]]%)";
    graph.valueField = "failure";
    graph.type = "column";
    graph.lineAlpha = 0;
    graph.fillAlphas = 1;
    graph.lineColor = "#C72C95";
    chart.addGraph(graph);

    // LEGEND
    var legend = new AmCharts.AmLegend();
    legend.horizontalGap = 10;
    legend.autoMargins = false;
    legend.marginLeft = 10;
    legend.marginRight = 20;
    legend.valueWidth = 0;
    legend.switchType = "v";
    chart.addLegend(legend);

    chart.export = {
      "enabled": true
    };

    // WRITE
    chart.write("chart_abridged");
  });

  AmCharts.ready(function() {
    // SERIAL CHART
    chart_detail = new AmCharts.AmSerialChart();
    chart_detail.dataProvider = test;
    chart_detail.categoryField = "classifier";

    // sometimes we need to set margins manually
    // autoMargins should be set to false in order chart to use custom margin values
    chart_detail.autoMargins = false;
    chart_detail.marginLeft = 0;
    chart_detail.marginRight = 0;
    chart_detail.marginTop = 30;
    chart_detail.marginBottom = 40;

    // AXES
    // category
    var categoryAxis = chart_detail.categoryAxis;
    categoryAxis.gridAlpha = 0;
    categoryAxis.axisAlpha = 0;
    categoryAxis.gridPosition = "start";

    // value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.stackType = "100%"; // this line makes the chart 100% stacked
    valueAxis.gridAlpha = 0;
    valueAxis.axisAlpha = 0;
    valueAxis.labelsEnabled = false;
    chart_detail.addValueAxis(valueAxis);

    // GRAPHS
    // first graph
    var graph = new AmCharts.AmGraph();
    graph.title = "Sucesso Não Evadidos";
    graph.labelText = "[[percents]]%";
    graph.balloonText = "Sucesso Não Evadidos: [[success_not_evaded]] ([[percents]]%)";
    graph.valueField = "success_not_evaded";
    graph.type = "column";
    graph.lineAlpha = 0;
    graph.fillAlphas = 1;
    graph.lineColor = "#C72C95";
    chart_detail.addGraph(graph);

    var graph = new AmCharts.AmGraph();
    graph.title = "Falha Não Evadidos";
    graph.labelText = "[[percents]]%";
    graph.balloonText = "Falha Não Evadidos: [[failure_not_evaded]] ([[percents]]%)";
    graph.valueField = "failure_not_evaded";
    graph.type = "column";
    graph.lineAlpha = 0;
    graph.fillAlphas = 1;
    graph.lineColor = "#C72C95";
    chart_detail.addGraph(graph);

    var graph = new AmCharts.AmGraph();
    graph.title = "Sucesso Evadidos";
    graph.labelText = "[[percents]]%";
    graph.balloonText = "Sucesso Evadidos: [[success_evaded]] ([[percents]]%)";
    graph.valueField = "success_evaded";
    graph.type = "column";
    graph.lineAlpha = 0;
    graph.fillAlphas = 1;
    graph.lineColor = "#C72C95";
    chart_detail.addGraph(graph);

    var graph = new AmCharts.AmGraph();
    graph.title = "Falha Evadidos";
    graph.labelText = "[[percents]]%";
    graph.balloonText = "Falha Evadidos: [[failure_evaded]] ([[percents]]%)";
    graph.valueField = "failure_evaded";
    graph.type = "column";
    graph.lineAlpha = 0;
    graph.fillAlphas = 1;
    graph.lineColor = "#C72C95";
    chart_detail.addGraph(graph);

    // LEGEND
    var legend = new AmCharts.AmLegend();
    legend.horizontalGap = 10;
    legend.autoMargins = false;
    legend.marginLeft = 10;
    legend.marginRight = 20;
    legend.valueWidth = 0;
    legend.switchType = "v";
    chart_detail.addLegend(legend);

    chart_detail.export = {
      "enabled": true
    };

    // WRITE
    chart_detail.write("chart_detail");
  });
});
</script>
@endsection
