@extends('layouts.base') @section('title', 'Curso') @section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Cursos
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                    <th>Classificar</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($objects as $object)
                    <tr>
                        <td><a href="{{ url('/development/course/'.$object['id']) }}">{{$object['name']}}</a></td>
                        <td>{{$object['students_evaded']}}</td>
                        <td>{{$object['students_not_evaded']}}</td>
                        <td>{{$object['students_formed']}}</td>
                        <td>{{$object['students_high_prob']}}</td>
                        <td>{{$object['students']}}</td>
                        <td>
                            @if($object['use_classify'] == 1)
                                <label class="m-checkbox" style="margin-bottom: 15px;"><input
                                            onchange="alterState('course/use_classify', {{$object['id']}} )" type="checkbox"
                                            checked="checked"><span></span></label>
                            @else
                                <label class="m-checkbox" style="margin-bottom: 15px;"><input
                                            onchange="alterState('course/use_classify',  {{$object['id']}}  )"
                                            type="checkbox"><span></span></label>
                            @endif
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
                    <form id="form_delete" name="form_delete" action="{{url('admin/user', [0])}}" method="POST">
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

@endsection @section('scripts')
    <script>
        function alterDelete(id) {
            document.getElementById("var_delete").value = id;
        }

        $(document).ready(function () {
            var table = $('#example').DataTable({
                responsive: true,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection
