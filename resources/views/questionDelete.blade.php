@extends('layouts.layout')
@section('title', 'Question Delete')
@section('content')
<section id="account" class="py-4">
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h1 class="mb-3"><i class="far fa-trash-alt mr-3"></i>Question Delete<small class="text-muted"> - 質問削除</small></h1>
			</div>
		</div>
		<hr>
	</div>
	<!-- 質問表示 -->
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h2 class="mb-3"><i class="fas fa-info-circle mr-3"></i>Information<small class="text-muted"> - 質問情報</small></h2>
				<p>{{$msg}}</p>
				{{ Form::open(['url' => 'questionDelete', 'method' => 'post']) }}
				{{ Form::hidden('id', $question->id)}}
				<table class="table">
					<tr><th>タイトル</th><td>{{$question->title}}</td></tr>
					<tr><th>カテゴリー</th><td>{{$question->category}}</td></tr>
					<tr><th>内容</th><td>{{$question->body}}</td></tr>
					<tr><th></th><td>{{Form::button('削除', ['type' => 'submit', 'class' => 'btn btn-secondary'])}}</td></tr>
				</table>
				{{Form::close()}}
			</div>
		</div>
	</div>		
</section>
@endsection