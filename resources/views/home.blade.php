@extends('app')

@section('styles')
<link href="{{ asset('/css/home.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel-body navi-list">
				<h2>选择方式：</h2>
				<a href="/data" class="navi-item">握力数据</a>
				<a href="/tips" class="navi-item">握力贴士</a>
			</div>
		</div>
	</div>
</div>
@endsection
