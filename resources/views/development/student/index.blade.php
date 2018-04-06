@extends('layouts.base') @section('title', 'Alunos') @section('content')
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
					<th>Status</th>
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
						<td>{{$object->semestre_situacao}}/{{$object->ano_situacao}}</td>
						<td>{{$object->periodo}}</td>
						<td>{{$object->cota}}</td>
						<td>{{$object->quant_semestre_cursados}}</td>
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
	$( document ).ready(function() {
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
                                column.search(this.value).draw();
                            }
                        });
                    } else {
                        var select = $('<select class="form-control"><option value="">Todos</option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    }
                });
            }
        });
	});
</script>
@endsection
