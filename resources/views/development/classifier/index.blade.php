@extends('layouts.base') @section('title', 'Classificadores') @section('content')
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Classificadores
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<table id="table" class="table table-striped table-bordered" style="width:100%">
				<thead>
				<tr>
					<th>Classificador</th>
					<th>Classificar</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($objects as $object)
					<tr>
						<td>{{$object['name']}}</td>
						<td>
							@if($object['use_classify'] == 1)
								<label class="m-checkbox" style="margin-bottom: 15px;"><input
											onchange="alterState('classifier/use_classify', {{$object['id']}} )" type="checkbox"
											checked="checked"><span></span></label>
							@else
								<label class="m-checkbox" style="margin-bottom: 15px;"><input
											onchange="alterState('classifier/use_classify',  {{$object['id']}}  )"
											type="checkbox"><span></span></label>
							@endif
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>


@endsection @section('scripts')
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
