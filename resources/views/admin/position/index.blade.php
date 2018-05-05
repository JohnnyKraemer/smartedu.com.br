@extends('layouts.base') @section('title', 'Cargos') @section('content')

	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Cargos
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
					<th>Nome</th>
					<th>Descrição</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($objects as $object)
					<tr>
						<td>{{$object->id}}</td>
						<td>{{$object->name}}</td>
						<td>{{$object->description}}</td>
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
