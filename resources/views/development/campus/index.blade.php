@extends('layouts.base') @section('title', 'Campus') @section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Campus
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th rowspan="2">Nome</th>
                    <th colspan="4">Alunos</th>
                </tr>
                <tr>
                    <th>Evadidos</th>
                    <th>Não Evadidos</th>
                    <th>Formados</th>
                    <th>APE</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($objects as $object)
                    <tr>
                        <td><a href="{{ url('/development/campus/'.$object['id']) }}">{{$object['name']}}</a></td>
                        <td>{{$object['students_evaded']}}</td>
                        <td>{{$object['students_not_evaded']}}</td>
                        <td>{{$object['students_formed']}}</td>
                        <td>{{$object['students_high_prob']}}</td>
                        <td>{{$object['students']}}</td>
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
            var table = $('#table').DataTable({
                responsive: true,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection
