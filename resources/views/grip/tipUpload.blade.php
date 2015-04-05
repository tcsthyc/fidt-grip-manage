@extends('app')


@section('styles')
<link href="{{ asset('/css/tipUpload.css') }}" rel="stylesheet">
@endsection

@section('content')
<h2>贴士上传</h2>
<form class="list" method="post" action="{{ url('/tips/upload') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="list-item">
		<label>贴士标题</label>
		<input type="text" name="title" class="item-text"></input>
	</div>
	<div class="list-item">
		<label id="content-label">贴士内容</label>
		<textarea name="content" id="content-area" rows="10" class="item-text"></textarea>
	</div>
	<div class="list-item">
		<input type="submit" value="保存"></input>
	</div>
</form>
@endsection
