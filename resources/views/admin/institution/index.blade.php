@extends('layouts.admin')

<!---------------- Inicio Compomentes ---------------
component('layouts.aside.institution')
endcomponent
<!---------------- Final de Compomentes ---------------->

@section('title', 'Instituição')

@section('stylesheets')
@endsection

@section('content')

    <!--
section('aside')
endsection
-->
    <div class="row">
        <div class="col-lg-8">
            <div class="m-portlet">
                <div class="m-portlet__body  m-portlet__body--no-padding">
                    <div class="row m-row--no-padding m-row--col-separator-xl">
                        <div class="col-md-12 col-lg-6 col-xl-4">
                            <!--begin::Total Profit-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        Não Evadidos
                                    </h4>
                                    <br>
                                    <span class="m-widget24__desc">
													Alunos não evadidos
									</span>
                                    <span class="m-widget24__stats m--font-brand">
													{{$total_by_situation_short[0]->total}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar" style="width: {{$total_by_situation_short[0]->percent}}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <span class="m-widget24__change">
													Percentual:
                                    </span>
                                    <span class="m-widget24__number">
													{{ number_format($total_by_situation_short[0]->percent,2) }}%
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-4">
                            <!--begin::New Feedbacks-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        Formados
                                    </h4>
                                    <br>
                                    <span class="m-widget24__desc">
													Alunos formados
												</span>
                                    <span class="m-widget24__stats m--font-info">
													{{$total_by_situation_short[1]->total}}
												</span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-info" role="progressbar" style="width: {{$total_by_situation_short[1]->percent}}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
													Percentual:
												</span>
                                    <span class="m-widget24__number">
													{{ number_format($total_by_situation_short[1]->percent,2) }}%
												</span>
                                </div>
                            </div>
                            <!--end::New Feedbacks-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-4">
                            <!--begin::New Orders-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        Evadidos
                                    </h4>
                                    <br>
                                    <span class="m-widget24__desc">
													Alunos evadidos
												</span>
                                    <span class="m-widget24__stats m--font-danger">
													{{$total_by_situation_short[2]->total}}
												</span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-danger" role="progressbar" style="width: {{$total_by_situation_short[2]->percent}}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
													Percentual:
												</span>
                                    <span class="m-widget24__number">
													{{ number_format($total_by_situation_short[2]->percent,2) }}%
												</span>
                                </div>
                            </div>
                            <!--end::New Orders-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Portlet-->
                    <div class="m-portlet m-portlet--tab">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon m--hide">
              <i class="la la-gear"></i>
            </span>
                                    <h3 class="m-portlet__head-text">
                                        Alunos Evadidos por Ano/Semestre
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
                    <!--begin::Portlet
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
        </div>
        <div class="col-lg-4">
            <div class="m-portlet">
                <div class="m-portlet__body  m-portlet__body--no-padding">
                    <div class="row m-row--no-padding m-row--col-separator-xl">
                        <div class="col-xl-12">
                            <!--begin:: Widgets/Stats2-1 -->
                            <div class="m-widget1">
                            @foreach ($courses as $course)

                                    <div class="m-widget1__item">
                                        <div class="row m-row--no-padding align-items-center">
                                            <div class="col-xl-9">
                                                <h3 class="m-widget1__title">
                                                    {{ $course['campus'] }}
                                                </h3>
                                                <span class="m-widget1__desc">
                                                    {{ $course['name'] }}
                                                </span>
                                            </div>
                                            <div class="col-xl-3 m--align-right">
                                                @if($course['students_evaded_percent'] > 50)
                                                    <span class="m-widget1__number m--font-danger">
                                                        {{ number_format($course['students_evaded_percent'],2) }} %
                                                    </span>
                                                @else
                                                    <span class="m-widget1__number m--font-brand">
                                                        {{ number_format($course['students_evaded_percent'],2) }} %
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                        @endforeach
                        <!--end:: Widgets/Stats2-1 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Alunos Evadidos por Ano/Semestre
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin: Datatable -->
            <div class="m_datatable" id="local_data"></div>
            <input type="hidden" id="objects" name="objects" value="{{$objects}}">
            <!--end: Datatable -->
        </div>
    </div>

    <input type="hidden" id="evaded_by_yaer_semester" name="evaded_by_yaer_semester"
           value="{{$evaded_by_yaer_semester}}">


@endsection
@section('scripts')


    <script>
        $(document).ready(function () {
            var objects = JSON.parse(document.getElementById("objects").value);
            var evaded_by_yaer_semester = JSON.parse(document.getElementById("evaded_by_yaer_semester").value);
            //var courses = JSON.parse(document.getElementById("courses").value);

            console.log(objects);
            console.log(evaded_by_yaer_semester);
            //console.log(courses);

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
                    field: "name",
                    title: "Campus",
                    width: 90,
                }, {
                    field: "courses",
                    title: "Cursos",
                    width: 50
                }, {
                    field: "students_not_evaded",
                    title: "Não Evadidos",
                    width: 70
                }, {
                    field: "students_evaded",
                    title: "Evadidos",
                    width: 70
                }, {
                    field: "students_formed",
                    title: "Formados",
                    width: 70
                }, {
                    field: "students",
                    title: "Total",
                    width: 70
                }]
            });

            /*
            var datatable_course = $('.m_course').mDatatable({
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
                    scroll: false,
                    height: 450,
                    footer: false
                },
                sortable: true,
                filterable: false,
                pagination: true,
                columns: [{
                    field: "name",
                    title: "Campus",
                    width: 150,
                }, {
                    field: "students_evaded_percent",
                    title: "Cursos",
                    width: 50
                }]
            });
            */

            var chart_short;
            var chart_detail;

            chart_short = AmCharts.makeChart("chart_short", {
                    "type": "serial",
                    "categoryField": "ano_semestre",
                    "marginBottom": 0,
                    "startDuration": 1,
                    "theme": "light",
                    "categoryAxis": {
                        "gridPosition": "start"
                    },
                    "chartCursor": {
                        "enabled": true
                    },
                    "chartScrollbar": {
                        "enabled": true
                    },
                    "trendLines": [],
                    "graphs": [
                        {
                            "fillAlphas": 1,
                            "fontSize": -2,
                            "id": "AmGraph-1",
                            "lineThickness": 2,
                            "title": "graph 1",
                            "type": "column",
                            "valueField": "total"
                        }
                    ],
                    "guides": [],
                    "allLabels": [],
                    "balloon": {},
                    "dataProvider": evaded_by_yaer_semester
                }
            );
            /*
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
                        */
        });
    </script>
@endsection
