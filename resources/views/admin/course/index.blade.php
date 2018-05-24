@extends('layouts.base')
@section('title', 'Curso')

@section('stylesheets')

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title" style="width: 100%;">
                            <span class="m-portlet__head-icon m--hide">
                              <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text" style="text-align: left; width: 70px;">
                                Curso:
                            </h3>
                            <h3 class="m-portlet__head-text" style="text-align: left; width: 80%;">
                                <select class="form-control m-select2" id="m_select2_1" name="param"
                                        onchange="location = './'+this.value;">
                                    @if(auth()->user()->position_id == 1 || auth()->user()->position_id == 2)
                                        @foreach($all_campus as $campus)
                                            <optgroup label="{{$campus->name}}">
                                                @foreach($campus->courses as $course)
                                                    @if($course->id == $object->id)
                                                        <option value="{{$course->id}}" selected>
                                                            {{$course->name}}
                                                        </option>
                                                    @else
                                                        <option value="{{$course->id}}">
                                                            {{$course->name}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    @else
                                        @foreach($courses as $course)
                                            @if($course->id == $object->id)
                                                <option value="{{$course->id}}" selected>
                                                    {{$course->name}}
                                                </option>
                                            @else
                                                <option value="{{$course->id}}">
                                                    {{$course->name}}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </h3>
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

        <div class="col-lg-6">
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
                                Alunos por Idade de Situação
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body" style="padding: 0;">
                    <div id="chart_idade_situacao" style="height: 280px;"></div>
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
                        Alunos
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ingresso</th>
                    <th>Período</th>
                    <th>Cota</th>
                    <th>Quant. Sem. Cursados</th>
                    <th>Prob. Evasão</th>
                    <th>Situação</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
                <tbody>
                @foreach ($objects as $object)
                    <tr>
                        <td>
                            <a href="{{ url('/admin/student/'.$object->id) }}">{{--Aluno ({{$object->code}})--}}########</a>
                        </td>
                        <td>{{$object->semester_ingress}}/{{$object->year_ingress}}</td>
                        <td>{{$object->period}}</td>
                        <td>{{$object->quota}}</td>
                        <td>{{$object->semesters}}</td>
                        <td>{{ number_format(($object->probability_evasion * 100), 2)}} %</td>
                        <td>{{$object->situation_long}}</td>
                        <td>{{$object->situation_short}}</td>
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
            var students_by_idade_situacao = JSON.parse({!! json_encode($students_by_age_situation) !!});
            var students_by_semesters = JSON.parse({!! json_encode($students_by_semesters) !!});
            var students_by_genre = JSON.parse({!! json_encode($students_by_genre) !!});
            var students_by_ano_semestre = JSON.parse({!! json_encode($students_by_ano_semestre) !!});


            var ocultas = [3,4];
            var texto = [0];
            var selecionar = [1, 2, 3, 4, 5, 6, 7];
            var table = initTable(true, true, texto, selecionar, ocultas);

            students_by_semesters = normalizeData(students_by_semesters);
            AmCharts.makeChart("chart_students_by_semesters", {
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
                "dataProvider": students_by_semesters
            });

            students_by_idade_situacao = normalizeData(students_by_idade_situacao);
            AmCharts.makeChart("chart_idade_situacao", {
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
                "dataProvider": students_by_idade_situacao
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

            $('#m_select2_1').select2({
                placeholder: "Selecione"
            });
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
