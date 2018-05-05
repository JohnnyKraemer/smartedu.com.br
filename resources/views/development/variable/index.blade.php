@extends('layouts.base') @section('title', 'Variáveis') @section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Variáveis
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Classificar</th>
                    <th>Discretizar</th>
                    <th>Nominal</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($objects as $object)
                    <tr>
                        <td>{{$object['name']}}</td>
                        <td>
                            @if($object['use_classify'] == 1)
                                <label class="m-checkbox" style="margin-bottom: 15px;"><input
                                            onchange="alterState('variable/use_classify', {{$object['id']}} )"
                                            type="checkbox"
                                            checked="checked"><span></span></label>
                            @else
                                <label class="m-checkbox" style="margin-bottom: 15px;"><input
                                            onchange="alterState('variable/use_classify',  {{$object['id']}}  )"
                                            type="checkbox"><span></span></label>
                            @endif
                        </td>
                        <td>
                            @if($object['discretize'] == 1)
                                <label class="m-checkbox" style="margin-bottom: 15px;"><input
                                            onchange="alterState('variable/discretize', {{$object['id']}} )"
                                            type="checkbox"
                                            checked="checked"><span></span></label>
                            @else
                                <label class="m-checkbox" style="margin-bottom: 15px;"><input
                                            onchange="alterState('variable/discretize',  {{$object['id']}}  )"
                                            type="checkbox"><span></span></label>
                            @endif
                        </td>
                        <td>
                            @if($object['nominal'] == 1)
                                <label class="m-checkbox" style="margin-bottom: 15px;"><input
                                            onchange="alterState('variable/nominal', {{$object['id']}} )"
                                            type="checkbox"
                                            checked="checked"><span></span></label>
                            @else
                                <label class="m-checkbox" style="margin-bottom: 15px;"><input
                                            onchange="alterState('variable/nominal',  {{$object['id']}}  )"
                                            type="checkbox"><span></span></label>
                            @endif
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
