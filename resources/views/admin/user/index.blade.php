@extends('layouts.base')
@section('title', 'Usuários')

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Usuários
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <a href="{{ url('/admin/user/create') }}"
                   class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                            <span>
                                <span>Novo Usuário</span>
                            </span>
                </a>
            </div>
        </div>
        <div class="m-portlet__body">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Campus</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($objects as $object)
                    <tr>
                        <td><a href="{{ url('/admin/user/'.$object['id']) }}">{{$object['name']}}</a></td>
                        <td>{{$object->position->name}}</td>
                        <td>
                            @if($object->campus == "-")
                                -
                            @else
                                {{$object->campus->name}}
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/admin/user/'.$object['id'].'/edit') }}"
                               class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                               title="Editar">
                                <i class="la la-edit"></i>
                            </a>

                            <a onclick="return alterDelete({{$object->id}});" data-toggle="modal"
                               data-target="#m_modal_1"
                               class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                               title="Deletar">
                                <i class="la la-remove"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Deletar
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						&times;
					</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Tem certeza que deseja deletar este registro?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="form_delete" name="form_delete" action="{{ url('/admin/user/delete') }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" id="var_delete" name="var_delete" value="0">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-danger" value="Deletar"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
@endsection
@section('scripts')
    <script>
        function alterDelete(id) {
            document.getElementById("var_delete").value = id;
        }

        var ocultas = null;
        var texto = [0];
        var selecionar = [1,2];


        $(document).ready(function () {
            var table = initTable(true, false,texto,selecionar,ocultas);
        });
    </script>
@endsection