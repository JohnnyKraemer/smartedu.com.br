@extends('layouts.template') @section('title', 'Usuário') @section('content')
<h1>Showing Task {{ $object->name }}</h1>

<div class="jumbotron text-center">
	<p>
		<strong>Nome:</strong> {{ $object->name }}<br>
		<strong>Email:</strong> {{ $object->email }}
	</p>
</div>
@endsectionadmin
