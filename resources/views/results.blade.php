@extends('layouts.app')
@section('title') Results @stop

@section('content')
<div class="container">
	<div class="page-header">
		<h3>Mini URL has been created</h3>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="panel-title">
				Results
			</span>
		</div> <!--/. panel-heading -->
		<div class="panel-body">
			<ul class="list-group">
				<li class="list-group-item">
					@if (str_contains($url->actual_url, 'http://') OR str_contains($url->actual_url, 'https://'))
					<b>Following URL: <br></b> {{ $url->actual_url }} <br><br>
					<span class="text-muted">It has length of <b>{{ strlen($url->actual_url) }}</b> characters.</span>
					@else
					<b>Following URL: <br></b> {{ "http://".$url->actual_url }} <br><br>
					<span class="text-muted">It has length of <b>{{ strlen($url->actual_url) }}</b> characters.</span>
					@endif
				</li>
				<li class="list-group-item">
					<b>Your miniURL is:</b>
					<a href="{{ config('app.url').'/'.$url->name }}" target="__blank" id="url">
						{{ config('app.url').'/'.$url->name }}
					</a> (click to open on new window.) or <a href="#!" id="copyToClipBoardBtn">Copy it to clipboard</a>
					<span id="copyAlert" class="text-warning" style="display: none;"><i>Copied to clipboard!</i></span>
					<textarea id="hiddenURLtext" style="opacity:0;">{{ config('app.url').'/'.$url->name }}</textarea>
					<br><br>
					<a href="{{ route('index') }}">
						<button class="btn btn-success"><b>Minify another URL</b></button>
					</a>
				</li>
			</ul>
		</div><!--/. panel-body -->
	</div> <!--/. panel panel-default -->
</div><!--/. container -->
@stop

@section('javascript')
<script type="text/javascript">
	$(document).ready(function() {
		$('#copyToClipBoardBtn').on('click', function() {
			let copyText = document.querySelector('#hiddenURLtext');
			copyText.select();
			try{
				let copied = document.execCommand("Copy");
				if (copied) {
					$('#copyAlert').show();
					console.log(copyText);
				} else if (!copied) {
					console.log('Unable to copy.');
				}
			} catch(err) {
				console.log("error:" + err);
			}
		});
	});
</script>
@stop