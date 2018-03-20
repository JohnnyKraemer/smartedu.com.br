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

<!--
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__body" style="padding: 6px;">
        <div class="m-form m-form--label-align-right">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="form-group m-form__group row align-items-center">
                        <div class="col-md-3">
                            <div class="d-md-none m--margin-bottom-10"></div>
                        </div>
                        <div class="col-md-3">

                            <div class="d-md-none m--margin-bottom-10"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="m-form__group m-form__group--inline">
                                <div class="m-form__label">
                                    <label>Periodo Calculado:</label>
                                </div>
                                <div class="m-form__control">
                                    <select id="m_form_period_calculation"
                                            class="form-control m-bootstrap-select m-bootstrap-select--solid">
                                        <option value="">Todos</option>
                                        @foreach($period_calculation_all as $period_calculation)
                                            <option value="{{$period_calculation->period_calculation}}">
                                                {{$period_calculation->period_calculation}}
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
    </div>
</div>
-->

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
                            Resultado Geral - Resumido
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body" style="padding: 0;">
                <div id="chart_short" style="height: 280px;"></div>
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
                            Resultado Geral - Detalhado
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
                    Melhor classificação por Curso
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
                                    <select id="m_form_classifier"
                                            class="form-control m-bootstrap-select m-bootstrap-select--solid">
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
                                    <select id="m_form_variable"
                                            class="form-control m-bootstrap-select m-bootstrap-select--solid">
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
                                    <select id="m_form_course"
                                            class="form-control m-bootstrap-select m-bootstrap-select--solid">
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
        $(document).ready(function () {
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
                }, {
                    field: "classifier_name",
                    title: "Classificador",
                    width: 150,
                }, {
                    field: "variables_name",
                    title: "Variáveis",
                    width: 150
                }, {
                    field: "success_percent",
                    title: "Sucesso",
                    template: function (row) {
                        return parseFloat(row.success_percent).toFixed(2) + "%";
                    }
                }, {
                    field: "course_name",
                    title: "Curso",
                    width: 150
                }, {
                    field: "campus_name",
                    title: "Campus",
                    width: 150
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
            $('#m_form_period_calculation').selectpicker();


            var chart_short;
            var chart_detail;
            
            chart_short = AmCharts.makeChart( "chart_short", {
                "type": "pie",
                "theme": "light",
                "dataProvider": [ {
                    "tipo": "Sucesso",
                    "resultado": test["0"].success
                }, {
                    "tipo": "Falha",
                    "resultado": test["0"].failure
                }],
                "valueField": "resultado",
                "titleField": "tipo",
                "balloon":{
                    "fixedPosition":true
                },
                "export": {
                    "enabled": true
                }
            } );

            chart_detail = AmCharts.makeChart( "chart_detail", {
                "type": "pie",
                "theme": "light",
                "dataProvider": [ {
                    "tipo": "Sucesso Evadido",
                    "resultado": test["0"].success_evaded
                },{
                    "tipo": "Sucesso Não Evadido",
                    "resultado": test["0"].success_not_evaded
                },{
                    "tipo": "Falha Evadio",
                    "resultado": test["0"].failure_evaded
                }, {
                    "tipo": "Falha Não Evadio",
                    "resultado": test["0"].failure_not_evaded
                }],
                "valueField": "resultado",
                "titleField": "tipo",
                "balloon":{
                    "fixedPosition":true
                },
                "export": {
                    "enabled": true
                }
            } );
        });
    </script>
@endsection
