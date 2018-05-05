@extends('layouts.base')
@section('title', 'Situação do Aluno')

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Situação do Aluno
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__head-tools">
            </div>
        </div>
        <div class="m-portlet__body">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Situação Completa</th>
                    <th>Situação Resumida</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($objects as $object)
                    <tr>
                        <td>{{$object->id}}</td>
                        <td>{{$object->situation_long}}</td>
                        <td>{{$object->situation_short}}</td>
                        <td>
                            <a href="{{ url('/admin/situation/'.$object['id'].'/edit') }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Editar">
                                <i class="la la-edit"></i>
                            </a>
                        </td>
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
            var ocultas = null;
            var texto = [0];
            var selecionar = [1, 2];
            var table = initTable(true, false, texto, selecionar, ocultas);
        });
    </script>
@endsection
