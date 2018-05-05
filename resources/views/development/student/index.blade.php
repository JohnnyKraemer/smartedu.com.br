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
			<table id="table" class="table table-striped table-bordered" style="width:100%">
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
							<a href="{{ url('/admin/student/'.$object->id) }}">{{ucwords(strtolower($object->name))}}</a>
						</td>
						<td>{{$object->semester_situation}}/{{$object->year_situation}}</td>
						<td>{{$object->period}}</td>
						<td>{{$object->quota}}</td>
						<td>{{$object->semesters}}</td>
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
        var ocultas = null;
        var texto = [0];
        var selecionar = [1, 2];
        var table = initTable(true, false, texto, selecionar, ocultas);
	});
</script>
@endsection
