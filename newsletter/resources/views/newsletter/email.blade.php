<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Newsletter</h1>
		@foreach ($items as $item)
		<div class="item">
			<h2><a href="{{ $item['link'] }}" target="_blank">{{ $item['title'] }}</a></h2>
			<p><strong>Link: </strong>{{ $item['link'] }}</p>
			<p>{!! $item['description'] !!}</p>
		</div>
		@endforeach
	</body>
</html>