@extends('layouts.admin')
@section('title', 'Campus')

@section('stylesheets')
@endsection

@section('content')
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
                                Câmpus: {{$object->name}}
                            </h3>
                        </div>

                    </div>
                    <div class="m-portlet__head-tools">
                        <div class="m-form__group m-form__group--inline">
                            <div class="m-form__control">
                                <select id="m_form_campus"  onchange="location = './'+this.value;"
                                        class="form-control m-bootstrap-select m-bootstrap-select--solid">
                                    @foreach($campus as $camp)
                                        @if($camp->id == $object->id)
                                            <option value="{{$camp->id}}" selected onclick="">
                                                {{$camp->name}}
                                            </option>
                                        @else
                                            <option value="{{$camp->id}}">
                                                {{$camp->name}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                        {{$object->students_not_evaded}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar"
                                             style="width: {{$object->students_not_evaded_percent}}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <span class="m-widget24__change">
                                        Percentual:
                                    </span>
                                    <span class="m-widget24__number">
                                        {{ $object->students_not_evaded_percent }}%
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
                                        {{$object->students_formed}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-info" role="progressbar"
                                             style="width: {{$object->students_formed_percent}}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                        Percentual:
                                    </span>
                                    <span class="m-widget24__number">
                                        {{ $object->students_formed_percent }}%
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
                                        {{$object->students_evaded}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-danger" role="progressbar"
                                             style="width: {{$object->students_evaded_percent}}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                        Percentual:
                                    </span>
                                    <span class="m-widget24__number">
                                        {{ $object->students_evaded_percent }}%
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
                                        {{$object->students_high_prob}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-warning" role="progressbar"
                                             style="width: {{$object->students_high_prob_percent}}%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                        Percentual:
                                    </span>
                                    <span class="m-widget24__number">
                                        {{ $object->students_high_prob_percent }}%
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
                                Alunos Evadidos por Curso
                                <small>
                                    Percentual em relação ao total de alunos do curso.
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
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                      <i class="la la-gear"></i>
                                    </span>
                            <h3 class="m-portlet__head-text">
                                Alunos Evadidos por Gênero
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body" style="padding: 0;">
                    <div id="chart_evaded_by_genre" style="height: 280px;"></div>
                </div>
            </div>
        </div>
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
        </div>
        <div class="col-lg-4">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                      <i class="la la-gear"></i>
                                    </span>
                            <h3 class="m-portlet__head-text">
                                Alunos Evadidos por Período
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
                        Alunos Evadidos por Ano/Semestre
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th rowspan="2">Curso</th>
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
                @foreach ($objects as $object)
                    <tr>
                        <td><a href="{{ url('/admin/course/'.$object->id) }}">{{$object['name']}}</a></td>
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
    <input type="hidden" id="students_evaded_by_genre" name="students_evaded_by_genre"
           value="{{$students_evaded_by_genre}}">
    <input type="hidden" id="students_evaded_by_period" name="students_evaded_by_period"
           value="{{$students_evaded_by_period}}">

    <input type="hidden" id="object" name="object" value="{{$object}}">
    <input type="hidden" id="objects" name="objects" value="{{$objects}}">
    <input type="hidden" id="bests_test" name="bests_test" value="{{$bests_test}}">
@endsection
@section('scripts')


    <script>
        $(document).ready(function () {
            var object = JSON.parse(document.getElementById("object").value);
            var objects = JSON.parse(document.getElementById("objects").value);
            var bests_test = JSON.parse(document.getElementById("bests_test").value);
            var evaded_by_yaer_semester = JSON.parse(document.getElementById("evaded_by_yaer_semester").value);
            var students_evaded_by_genre = JSON.parse(document.getElementById("students_evaded_by_genre").value);
            var students_evaded_by_period = JSON.parse(document.getElementById("students_evaded_by_period").value);

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
                    "dataProvider": objects
                }
            );

            AmCharts.makeChart("chart_evaded_by_genre", {
                "type": "pie",
                "theme": "light",
                "dataProvider": [{
                    "tipo": "Feminino",
                    "resultado": students_evaded_by_genre["0"].total
                }, {
                    "tipo": "Masculino",
                    "resultado": students_evaded_by_genre["1"].total
                }],
                "valueField": "resultado",
                "titleField": "tipo",
                "balloon": {
                    "fixedPosition": true
                },
                "export": {
                    "enabled": true
                }
            });

            AmCharts.makeChart("chart_evaded_by_period", {
                    "type": "serial",
                    "categoryField": "periodo",
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
                            "balloonText": "Alunos Evadidos: [[value]]",
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
                    "dataProvider": students_evaded_by_period
                }
            );

            $('#m_form_campus').selectpicker();
        });
    </script>
@endsection
