@extends('layouts.admin')
@section('title', 'Campus')

@section('stylesheets')
    <style>
        tfoot {
            display: table-header-group;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title" style="width: 670px;">
                            <span class="m-portlet__head-icon m--hide">
                              <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text" style="text-align: left; width: 70px;">
                                Curso:
                            </h3>
                            <h3 class="m-portlet__head-text" style="text-align: left; width: 600px;">
                                <select class="form-control m-select2" id="m_select2_1" name="param"
                                        onchange="location = './'+this.value;">
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
                                Alunos Evadidos Gênero
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
                        Alunos
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sem/Ano Ingresso</th>
                    <th>Período</th>
                    <th>Cota</th>
                    <th>Quant. Sem. Cursados</th>
                    <th>Prob. Evasão</th>
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
                </tr>
                </tfoot>
                <tbody>
                @foreach ($objects as $object)
                    <tr>
                        <td>
                            <a href="{{ url('/admin/student/'.$object->id) }}">{{ucwords(strtolower($object->nome))}}</a>
                        </td>
                        <td>{{$object->semestre_ingresso}}/{{$object->ano_ingresso}}</td>
                        <td>{{$object->last_details->periodo}}</td>
                        <td>{{$object->cota}}</td>
                        <td>{{$object->last_details->quant_semestre_cursados}}</td>
                        <td>{{$object->prob_evaded}}</td>
                        <td>{{$object->situation->situation_long}}</td>
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
    <input type="hidden" id="students_evaded_by_genre_complete" name="students_evaded_by_genre_complete"
           value="{{$students_evaded_by_genre_complete}}">
    <input type="hidden" id="students_evaded_by_period" name="students_evaded_by_period"
           value="{{$students_evaded_by_period}}">
    <input type="hidden" id="students_by_idade_ingresso" name="students_by_idade_ingresso"
           value="{{$students_by_idade_ingresso}}">
    <input type="hidden" id="bests_test" name="bests_test" value="{{$bests_test}}">
    <input type="hidden" id="object" name="object" value="{{$object}}">
@endsection
@section('scripts')


    <script>
        $(document).ready(function () {
            var object = JSON.parse(document.getElementById("object").value);
            var bests_test = JSON.parse(document.getElementById("bests_test").value);
            var evaded_by_yaer_semester = JSON.parse(document.getElementById("evaded_by_yaer_semester").value);
            var students_evaded_by_genre = JSON.parse(document.getElementById("students_evaded_by_genre").value);
            var students_evaded_by_period = JSON.parse(document.getElementById("students_evaded_by_period").value);
            var students_evaded_by_genre_complete = JSON.parse(document.getElementById("students_evaded_by_genre_complete").value);
            var students_by_idade_ingresso = JSON.parse(document.getElementById("students_by_idade_ingresso").value);

            console.log(students_by_idade_ingresso);


            var table = $('#example').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                },
                initComplete: function () {
                    table.columns().eq(0).each(function (index) {
                        var column = table.column(index);
                        if (index == 0) {
                            var select = $('<input type="text" class="form-control m-input" placeholder="Pesquisar" />')
                                .appendTo($(column.footer()).empty());
                            $('input', column.footer()).on('keyup change', function () {
                                if (column.search() !== this.value) {
                                    column
                                        .search(this.value)
                                        .draw();
                                }
                            });
                        } else {


                            var select = $('<select class="form-control"><option value="">Todos</option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });

                        }
                    });

                }
            });

            var st;
            var i = 0;
            students_by_idade_ingresso.forEach(function(object){

                if(object.idade_ingresso){

                }
            });

            var chart_short = AmCharts.makeChart("chart_idade_ingresso",{
                    "type": "serial",
                    "categoryField": "idade_ingresso",
                    "startDuration": 1,
                    "categoryAxis": {
                        "gridPosition": "start"
                    },
                    "trendLines": [],
                    "graphs": [
                        {
                            "balloonText": "[[title]] of [[category]]:[[value]]",
                            "fillAlphas": 0.7,
                            "id": "AmGraph-1",
                            "lineAlpha": 0,
                            "title": "Evadidos",
                            "valueField": "total"
                        },
                        {
                            "balloonText": "[[title]] of [[category]]:[[value]]",
                            "fillAlphas": 0.7,
                            "id": "AmGraph-1",
                            "lineAlpha": 0,
                            "title": "Formados",
                            "valueField": "total"
                        }
                    ],
                    "guides": [],
                    "valueAxes": [
                        {
                            "id": "ValueAxis-1",
                            "title": "Axis title"
                        }
                    ],
                    "allLabels": [],
                    "balloon": {},
                    "legend": {
                        "enabled": true
                    },
                    "titles": [
                        {
                            "id": "Title-1",
                            "size": 15,
                            "text": "Chart Title"
                        }
                    ],
                    "dataProvider": students_by_idade_ingresso
            });

            var chart_short1 = AmCharts.makeChart("chart_evaded_by_genre_complete", {
                    "type": "serial",
                    "categoryField": "category",
                    "startDuration": 1,
                    "categoryAxis": {
                        "gridPosition": "start"
                    },
                    "trendLines": [],
                    "graphs": [
                        {
                            "balloonText": "[[title]]:[[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-1",
                            "title": "Evadido",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "column-1"

                        },
                        {
                            "balloonText": "[[title]]:[[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-2",
                            "title": "Formado",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "column-2"
                        },
                        {
                            "balloonText": "[[title]]:[[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-3",
                            "title": "Não Evadido",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "column-3"
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
                    "dataProvider": [
                        {
                            "category": "Feminino",
                            "column-1": students_evaded_by_genre_complete[0].total,
                            "column-2": students_evaded_by_genre_complete[2].total,
                            "column-3": students_evaded_by_genre_complete[4].total,
                            "total": (students_evaded_by_genre_complete[0].total +
                                students_evaded_by_genre_complete[2].total +
                                students_evaded_by_genre_complete[4].total)
                        },
                        {
                            "category": "Masculino",
                            "column-1": students_evaded_by_genre_complete[1].total,
                            "column-2": students_evaded_by_genre_complete[3].total,
                            "column-3": students_evaded_by_genre_complete[5].total,
                            "total": (students_evaded_by_genre_complete[1].total +
                                students_evaded_by_genre_complete[3].total +
                                students_evaded_by_genre_complete[5].total)

                        }
                    ]
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
                            "labelText": "[[total]]",
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
    <script src="<?php echo asset('/public/assets/demo/default/custom/components/forms/widgets/select2.js') ?>"
            type="text/javascript"></script>
@endsection
