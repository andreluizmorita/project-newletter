@extends('main')

@section('content')
	<div class="header">
		<h1><a href="{{ $permalink }}" target="_blank">{{ $title }}</a></h1>
	</div>

	<form role="form" method="POST" action="{{ url('/newsletter') }}">
        {{ csrf_field() }}
		<div class="row item-title">
			<div class="col-sm-1">
				<strong>Selecione</strong>
			</div>
			<div class="col-sm-11 newsletter-title">
				<strong>Conteúdo da newsletter</strong>
			</div>
		</div>
		@foreach ($items as $item)
		<div class="row item">
			<div class="col-sm-1">
				<input type="checkbox" name="news[]" value="{{ $item['link'] }}">
			</div>
			<div class="col-sm-11 newsletter">
				<h2><a href="{{ $item['link'] }}" target="_blank">{{ $item['title'] }}</a></h2>
				<p><strong>Link: </strong>{{ $item['link'] }}</p>
				<p>{!! $item['description'] !!}</p>
			</div>
		</div>
		@endforeach
		
		
		<div class="row item">
			<div class="col-sm-1">
			</div>
			<div class="col-sm-11">
				<input type="email" name="email" class="form-control" placeholder="E-mail para envio"> 
			</div>
		</div>
		<div class="row item">
			<div class="col-sm-12"><br />
				<button type="submit" class="btn btn-primary pull-right">Enviar</button>
			</div>
		</div>


	</form>

@endsection