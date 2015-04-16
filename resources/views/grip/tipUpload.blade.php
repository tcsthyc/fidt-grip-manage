@extends('app')


@section('styles')
<link href="{{ asset('/css/tipUpload.css') }}" rel="stylesheet">
@endsection

@section('content')
<h2>贴士上传</h2>
<form method="post" action="{{ url('/tips/upload') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="tip-header">
		<label>贴士标题</label>
		<input type="text" name="title" class="item-text"></input>
	</div>
	<div class="tip-content">
		<div class="content-item">
			<p>问题</p>
			<textarea name="question" class="content-area" rows="10" class="item-text"></textarea>
		</div>
		<div class="content-item">
			<p>回答</p>
			<textarea name="answer" class="content-area" rows="10" class="item-text"></textarea>
		</div>
	</div>
	<div class="list-item">
		<input type="submit" value="保存"></input>
	</div>
</form>
@endsection
