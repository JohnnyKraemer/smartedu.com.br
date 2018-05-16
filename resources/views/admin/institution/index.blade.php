@extends('layouts.base')
@section('title', 'Instituição')

@section('stylesheets')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <div class="m-portlet__body  m-portlet__body--no-padding">
                    <div class="row m-row--no-padding m-row--col-separator-xl">
                        <div class="col-md-12 col-lg-6 col-xl-3">
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
                                        {{$total_by_situation_short[2]->total}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar"
                                             style="width: {{$total_by_situation_short[2]->percent}}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <span class="m-widget24__change">
                                        Percentual:
                                    </span>
                                    <span class="m-widget24__number">
                                        {{ $total_by_situation_short[2]->percent }}%
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
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
                                        <div class="progress-bar m--bg-info" role="progressbar"
                                             style="width: {{$total_by_situation_short[1]->percent}}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                        Percentual:
                                    </span>
                                    <span class="m-widget24__number">
                                        {{ $total_by_situation_short[1]->percent }}%
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
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
                                        {{$total_by_situation_short[0]->total}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-danger" role="progressbar"
                                             style="width: {{$total_by_situation_short[0]->percent}}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                        Percentual:
                                    </span>
                                    <span class="m-widget24__number">
                                        {{ $total_by_situation_short[0]->percent }}%
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        Provável Evasão
                                    </h4>
                                    <br>
                                    <span class="m-widget24__desc">
                                        Alta prob. de evadir
                                    </span>
                                    <span class="m-widget24__stats m--font-warning">
                                        {{$total_not_evaded_high_prob}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-warning" role="progressbar"
                                             style="width: {{ number_format((($total_not_evaded_high_prob/$total_by_situation_short[0]->total)*100),2) }}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                        Percentual:
                                    </span>
                                    <span class="m-widget24__number">
                                        {{ number_format((($total_not_evaded_high_prob/$total_by_situation_short[0]->total)*100),2) }}
                                        %
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                              <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Alunos por Campus
                                <small>
                                    Percentual em relação ao total de alunos do campus.
                                </small>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body" style="padding: 0;">
                    <div id="chart_students_by_campus" style="height: 280px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                              <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Alunos por Idade de Ingresso
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body" style="padding: 0;">
                    <div id="chart_idade_ingresso" style="height: 280px;"></div>
                </div>
            </div>
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                              <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Alunos por Idade de Situação
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body" style="padding: 0;">
                    <div id="chart_age_situation" style="height: 280px;"></div>
                </div>

            </div>
        </div>
        <div class="col-lg-5">
            <div class="m-portlet">
                <div class="m-portlet__body  m-portlet__body--no-padding">
                    <div class="row m-row--no-padding m-row--col-separator-xl">
                        <div class="col-xl-12">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Top 8 cursos com mais evasão
                                            <small>
                                                Entre todos os campus.
                                            </small>
                                        </h3>
                                    </div>
                                </div>
                            </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                      <i class="la la-gear"></i>
                                    </span>
                            <h3 class="m-portlet__head-text">
                                Alunos por Ano/Semestre
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body" style="padding: 0;">
                    <div id="chart_evaded_by_year_semester" style="height: 280px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                              <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Alunos por Gênero
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body" style="padding: 0;">
                    <div id="chart_evaded_by_genre_complete" style="height: 280px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                      <i class="la la-gear"></i>
                                    </span>
                            <h3 class="m-portlet__head-text">
                                Alunos por Quantidade de Semestres Cursados
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body" style="padding: 0;">
                    <div id="chart_students_by_semesters" style="height: 280px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                      <i class="la la-gear"></i>
                                    </span>
                            <h3 class="m-portlet__head-text">
                                Alunos por Período
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body" style="padding: 0;">
                    <div id="chart_evaded_by_period" style="height: 280px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Campus da Instituição
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th rowspan="2">Campus</th>
                    <th rowspan="2">Cursos</th>
                    <th colspan="5">Alunos</th>
                </tr>
                <tr>
                    <th>Evadidos</th>
                    <th>Não Evadidos</th>
                    <th>Formados</th>
                    <th>Total</th>
                    <th>APE</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($campus as $object)
                    <tr>
                        <td><a href="{{ url('/admin/campus/'.$object['id']) }}">{{$object['name']}}</a></td>
                        <td>{{$object['count_courses']}}</td>
                        <td>{{$object['students_evaded']}}</td>
                        <td>{{$object['students_not_evaded']}}</td>
                        <td>{{$object['students_formed']}}</td>
                        <td>{{$object['students']}}</td>
                        <td>{{$object['students_high_prob']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')


    <script>
        $(document).ready(function () {
            var students_by_period = JSON.parse({!! json_encode($students_by_period) !!});
            var students_by_idade_ingresso = JSON.parse({!! json_encode($students_by_idade_ingresso) !!});
            var students_by_age_situation = JSON.parse({!! json_encode($students_by_age_situation) !!});
            var students_by_semesters = JSON.parse({!! json_encode($students_by_semesters) !!});
            var students_by_genre = JSON.parse({!! json_encode($students_by_genre) !!});
            var students_by_ano_semestre = JSON.parse({!! json_encode($students_by_ano_semestre) !!});
            var students_by_campus = JSON.parse({!! json_encode($students_by_campus) !!});

            var ocultas = null;
            var texto = [0];
            var selecionar = [1, 2];
            var table = initTable(true, false, texto, selecionar, ocultas);

            students_by_semesters = normalizeData(students_by_semesters);
            AmCharts.makeChart("chart_students_by_semesters", {
                "type": "serial",
                "language": "pt",
                "categoryField": "category",
                "startDuration": 1,
                "categoryAxis": {
                    "gridPosition": "start"
                },
                "chartCursor": {
                    "enabled": true
                },
                "valueScrollbar": {
                    "enabled": true
                }, "export": {
                    "enabled": true
                },
                "graphs": [
                    {
                        "balloonText": "[[title]] de [[category]]:[[value]]",
                        "fillAlphas": 0.7,
                        "id": "AmGraph-1",
                        "lineAlpha": 0,
                        "title": "Evadidos",
                        "valueField": "evadidos"
                    },
                    {
                        "balloonText": "[[title]] de [[category]]:[[value]]",
                        "fillAlphas": 0.7,
                        "id": "AmGraph-2",
                        "lineAlpha": 0,
                        "title": "Não Evadidos",
                        "valueField": "nao_evadidos"
                    },
                    {
                        "balloonText": "[[title]] de [[category]]:[[value]]",
                        "fillAlphas": 0.7,
                        "id": "AmGraph-3",
                        "lineAlpha": 0,
                        "title": "Formados",
                        "valueField": "formados"
                    }
                ],
                "legend": {
                    "enabled": true
                },
                "dataProvider": students_by_semesters
            });

            students_by_age_situation = normalizeData(students_by_age_situation);
            AmCharts.makeChart("chart_age_situation", {
                "type": "serial",
                "categoryField": "category",
                "startDuration": 1,
                "categoryAxis": {
                    "gridPosition": "start"
                },
                "chartCursor": {
                    "enabled": true
                },
                "valueScrollbar": {
                    "enabled": true
                }, "export": {
                    "enabled": true
                },
                "graphs": [
                    {
                        "balloonText": "[[title]] de [[category]]:[[value]]",
                        "fillAlphas": 0.7,
                        "id": "AmGraph-1",
                        "lineAlpha": 0,
                        "title": "Evadidos",
                        "valueField": "evadidos"
                    },
                    {
                        "balloonText": "[[title]] de [[category]]:[[value]]",
                        "fillAlphas": 0.7,
                        "id": "AmGraph-2",
                        "lineAlpha": 0,
                        "title": "Não Evadidos",
                        "valueField": "nao_evadidos"
                    },
                    {
                        "balloonText": "[[title]] de [[category]]:[[value]]",
                        "fillAlphas": 0.7,
                        "id": "AmGraph-3",
                        "lineAlpha": 0,
                        "title": "Formados",
                        "valueField": "formados"
                    }
                ],
                "legend": {
                    "enabled": true
                },
                "dataProvider": students_by_age_situation
            });

            students_by_idade_ingresso = normalizeData(students_by_idade_ingresso);
            AmCharts.makeChart("chart_idade_ingresso", {
                "type": "serial",
                "categoryField": "category",
                "startDuration": 1,
                "categoryAxis": {
                    "gridPosition": "start"
                },
                "chartCursor": {
                    "enabled": true
                },
                "valueScrollbar": {
                    "enabled": true
                }, "export": {
                    "enabled": true
                },
                "graphs": [
                    {
                        "balloonText": "[[title]] de [[category]]:[[value]]",
                        "fillAlphas": 0.7,
                        "id": "AmGraph-1",
                        "lineAlpha": 0,
                        "title": "Evadidos",
                        "valueField": "evadidos"
                    },
                    {
                        "balloonText": "[[title]] de [[category]]:[[value]]",
                        "fillAlphas": 0.7,
                        "id": "AmGraph-2",
                        "lineAlpha": 0,
                        "title": "Não Evadidos",
                        "valueField": "nao_evadidos"
                    },
                    {
                        "balloonText": "[[title]] de [[category]]:[[value]]",
                        "fillAlphas": 0.7,
                        "id": "AmGraph-3",
                        "lineAlpha": 0,
                        "title": "Formados",
                        "valueField": "formados"
                    }
                ],
                "legend": {
                    "enabled": true
                },
                "dataProvider": students_by_idade_ingresso
            });

            students_by_ano_semestre = normalizeData(students_by_ano_semestre);
            AmCharts.makeChart("chart_evaded_by_year_semester", {
                "type": "serial",
                "categoryField": "category",
                "startDuration": 1,
                "categoryAxis": {
                    "gridPosition": "start"
                },
                "chartCursor": {
                    "enabled": true
                },
                "valueScrollbar": {
                    "enabled": true
                }, "export": {
                    "enabled": true
                },
                "graphs": [
                    {
                        "balloonText": "[[title]] de [[category]]:[[value]]",
                        "fillAlphas": 0.7,
                        "id": "AmGraph-1",
                        "lineAlpha": 0,
                        "title": "Evadidos",
                        "valueField": "evadidos"
                    }, {
                        "balloonText": "[[title]] de [[category]]:[[value]]",
                        "fillAlphas": 0.7,
                        "id": "AmGraph-2",
                        "lineAlpha": 0,
                        "title": "Formados",
                        "valueField": "formados"
                    }
                ],
                "legend": {
                    "enabled": true
                },
                "dataProvider": students_by_ano_semestre
            });


            students_by_genre = normalizeData(students_by_genre);
            AmCharts.makeChart("chart_evaded_by_genre_complete", {
                    "type": "serial",
                    "categoryField": "category",
                    "startDuration": 1,
                    "categoryAxis": {
                        "gridPosition": "start"
                    },
                    "chartCursor": {
                        "enabled": true
                    },
                    "valueScrollbar": {
                        "enabled": true
                    }, "export": {
                        "enabled": true
                    },
                    "trendLines": [],
                    "graphs": [
                        {
                            "balloonText": "[[title]]: [[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-1",
                            "title": "Evadidos",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "evadidos"

                        },
                        {
                            "balloonText": "[[title]]: [[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-2",
                            "title": "Formados",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "formados"
                        },
                        {
                            "balloonText": "[[title]]: [[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-3",
                            "title": "Não Evadidos",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "nao_evadidos"
                        }
                    ],
                    "guides": [],
                    "valueAxes": [
                        {
                            "id": "ValueAxis-1",
                            "stackType": "regular",
                            //"title": "Axis title"
                        }
                    ],
                    "allLabels": [],
                    "balloon": {},
                    "legend": {
                        "enabled": true,
                        "useGraphSettings": true
                    },
                    "dataProvider": students_by_genre
                }
            );

            students_by_period = normalizeData(students_by_period);
            AmCharts.makeChart("chart_evaded_by_period", {
                    "type": "serial",
                    "categoryField": "category",
                    "startDuration": 1,
                    "categoryAxis": {
                        "gridPosition": "start"
                    },
                    "chartCursor": {
                        "enabled": true
                    },
                    "valueScrollbar": {
                        "enabled": true
                    }, "export": {
                        "enabled": true
                    },
                    "trendLines": [],
                    "graphs": [
                        {
                            "balloonText": "[[title]]: [[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-1",
                            "title": "Evadidos",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "evadidos"

                        },
                        {
                            "balloonText": "[[title]]: [[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-3",
                            "title": "Não Evadidos",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "nao_evadidos"
                        }
                    ],
                    "guides": [],
                    "valueAxes": [
                        {
                            "id": "ValueAxis-1",
                            "stackType": "regular",
                            //"title": "Axis title"
                        }
                    ],
                    "allLabels": [],
                    "balloon": {},
                    "legend": {
                        "enabled": true,
                        "useGraphSettings": true
                    },
                    "dataProvider": students_by_period
                }
            );

            students_by_campus = normalizeData(students_by_campus);
            AmCharts.makeChart("chart_students_by_campus", {
                    "type": "serial",
                    "categoryField": "category",
                    "startDuration": 1,
                    "categoryAxis": {
                        "gridPosition": "start"
                    },
                    "chartCursor": {
                        "enabled": true
                    },
                    "valueScrollbar": {
                        "enabled": true
                    }, "export": {
                        "enabled": true
                    },
                    "trendLines": [],
                    "graphs": [
                        {
                            "balloonText": "[[title]]: [[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-1",
                            "title": "Evadidos",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "evadidos"

                        },
                        {
                            "balloonText": "[[title]]: [[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-2",
                            "title": "Formados",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "formados"
                        },
                        {
                            "balloonText": "[[title]]: [[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-3",
                            "title": "Não Evadidos",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "nao_evadidos"
                        }
                    ],
                    "guides": [],
                    "valueAxes": [
                        {
                            "id": "ValueAxis-1",
                            "stackType": "regular",
                            //"title": "Axis title"
                        }
                    ],
                    "allLabels": [],
                    "balloon": {},
                    "legend": {
                        "enabled": true,
                        "useGraphSettings": true
                    },
                    "dataProvider": students_by_campus
                }
            );


        });


        function normalizeData(objects) {
            var categorys = [];
            var students = [];

            for (var i = 0; i < objects.length; i++) {
                categorys[i] = objects[i].category;
            }
            categorys = categorys.filter(function onlyUnique(value, index, self) {
                return self.indexOf(value) === index;
            });

            for (var i = 0; i < categorys.length; i++) {
                var item = objects.filter(function (v) {
                    return v.category === categorys[i]; // Filter out the appropriate one
                });

                students[i] = {
                    "category": categorys[i],
                    "formados": 0,
                    "evadidos": 0,
                    "nao_evadidos": 0
                }

                if (item != []) {
                    item.forEach(function (obj) {
                        if (obj.situation_short === "Evadido") {
                            students[i].evadidos = obj.total;
                        } else if (obj.situation_short === "Não Evadido") {
                            students[i].nao_evadidos = obj.total;
                        } else if (obj.situation_short === "Formado") {
                            students[i].formados = obj.total;
                        }
                    });
                }
            }
            return students;
        }
    </script>
@endsection
