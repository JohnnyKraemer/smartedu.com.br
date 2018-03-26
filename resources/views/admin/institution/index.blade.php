@extends('layouts.admin')
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
                                        {{$total_by_situation_short[0]->total}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar"
                                             style="width: {{$total_by_situation_short[0]->percent}}%;"
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
                                        {{ number_format($total_by_situation_short[1]->percent,2) }}%
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
                                        {{$total_by_situation_short[2]->total}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-danger" role="progressbar"
                                             style="width: {{$total_by_situation_short[2]->percent}}%;"
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
                                             style="width: {{$total_by_situation_short[2]->percent}}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                        Percentual:
                                    </span>
                                    <span class="m-widget24__number">
                                        {{ number_format((($total_not_evaded_high_prob/$total_by_situation_short[0]->total)*100),2) }}%
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
        <div class="col-lg-8">
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

            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                              <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Alunos Evadidos por Campus
                                <small>
                                    Percentual em relação ao total de alunos do campus.
                                </small>
                            </h3>

                        </div>
                    </div>
                </div>
                <div class="m-portlet__body" style="padding: 0;">
                    <div id="chart_evaded_by_campus" style="height: 280px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
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
            <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                    <th>Alta Prob. de Evasão</th>
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
    <input type="hidden" id="evaded_by_yaer_semester" name="evaded_by_yaer_semester"
           value="{{$evaded_by_yaer_semester}}">
    <input type="hidden" id="campus" name="campus" value="{{$objects}}">
    <input type="hidden" id="bests_test" name="bests_test" value="{{$bests_test}}">
@endsection
@section('scripts')


    <script>
        $(document).ready(function () {
            var campus = JSON.parse(document.getElementById("campus").value);
            var bests_test = JSON.parse(document.getElementById("bests_test").value);
            var evaded_by_yaer_semester = JSON.parse(document.getElementById("evaded_by_yaer_semester").value);

            $('#example').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            });


            var chart_short = AmCharts.makeChart("chart_short", {
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

            var chart_short1 = AmCharts.makeChart("chart_evaded_by_campus", {
                    "type": "serial",
                    "categoryField": "name",
                    "marginBottom": 0,
                    "startDuration": 1,
                    "theme": "light",
                    "categoryAxis": {
                        "gridPosition": "start"
                    },
                    "chartCursor": {
                        "enabled": true
                    },
                    "trendLines": [],
                    "graphs": [
                        {
                            "balloonText": "Alunos Evadidos: [[students_evaded]] - [[value]]%",
                            "fillAlphas": 1,
                            "fontSize": -2,
                            "id": "AmGraph-1",
                            "lineThickness": 2,
                            "title": "graph 1",
                            "type": "column",
                            "valueField": "students_evaded_percent"
                        }
                    ],
                    "guides": [],
                    "allLabels": [],
                    "balloon": {},
                    "dataProvider": campus
                }
            );
        });
    </script>
@endsection
