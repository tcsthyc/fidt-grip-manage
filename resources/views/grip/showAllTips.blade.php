@extends('app')


@section('styles')
<link href="{{ asset('/css/showAllTips.css') }}" rel="stylesheet">
@endsection

@section('content')
<h2>查看所有贴士</h2>
<div class="operate-panel">
	<div class="operate-bar">
		<a href="{{ url('/tips/upload') }}" class="button-add">添加</a>
	</div>
	<table>
		<tr>
			<td>标题</td>
			<td>作者</td>
			<td>编辑时间</td>
			<td>操作</td>
		</tr>

		@forelse ($tips as $tip)
			<tr>
				<td>{{ $tip->title  }}</td>
				<td>{{ $tip->user->name  }}</td>
				<td>{{ $tip->updated_at  }}</td>
				<td><a>详情</a><a>编辑</a><a>删除</a></td>
			</tr>
		@empty
			暂时没有贴士！
		@endforelse
	</table>
</div>
@endsection
