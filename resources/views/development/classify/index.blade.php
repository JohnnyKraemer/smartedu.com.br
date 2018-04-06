@extends('layouts.base')

@section('title', 'Classicação Geral')

@section('stylesheets')
@endsection

@section('content')
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
                    Alunos
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Classificador</th>
                <th>Variaveis</th>
                <th>Campus</th>
                <th>Curso</th>
                <th>Sucesso</th>
                <th>Falha</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($objects as $object)
                <tr>
                    <td>{{ucwords(strtolower($object->classifier_name))}}</td>
                    <td>{{$object->variables_name}}</td>
                    <td>{{$object->campus_name}}</td>
                    <td>{{$object->course_name}}</td>
                    <td>{{$object->success_percent}} %</td>
                    <td>{{$object->failure_percent}} %</td>
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
            var test = JSON.parse({!! json_encode($grafic_one) !!});
            var table = $('#example').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'print',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            });

            var chart_short;
            var chart_detail;

            chart_short = AmCharts.makeChart("chart_short", {
                "type": "pie",
                "theme": "light",
                "dataProvider": [{
                    "tipo": "Sucesso",
                    "resultado": test["0"].success
                }, {
                    "tipo": "Falha",
                    "resultado": test["0"].failure
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

            var bests = [];
            bests[0] = {
                "category": "Evadidos",
                "success": test["0"].success_evaded,
                "failure":  test["0"].failure_evaded
            }

            bests[1] = {
                "category": "Formados",
                "success": test["0"].success_not_evaded,
                "failure":  test["0"].failure_not_evaded
            }

            AmCharts.makeChart("chart_detail", {
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
                    },
                    "trendLines": [],
                    "graphs": [
                        {
                            "balloonText": "[[title]]: [[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-1",
                            "title": "Sucesso",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "success"

                        },
                        {
                            "balloonText": "[[title]]: [[value]] - [[percents]]%",
                            "fillAlphas": 1,
                            "id": "AmGraph-2",
                            "title": "Falha",
                            "type": "column",
                            "labelText": "[[percents]]%",
                            "valueField": "failure"
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
                    "dataProvider": bests
                }
            );
        });
    </script>
@endsection
