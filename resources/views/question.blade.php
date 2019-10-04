@extends('layouts.layout')
@section('title', 'Question')
@section('content')
<section id="" class="py-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1>Quesiton - <small>質問ページ</small></h1>
				<p>解らないことは誰かに聞いてみましょう！！</p>
				@if(isset($msg))
					<h2>{{$msg}}</h2>
				@endif
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col">
				
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col">
				
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col">
				<h2>最新の質問</h2>
				<table class="table">
					<tr><th>日時</th><th>質問タイトル</th><th>カテゴリー</th><th>質問者</th></tr>
					@foreach($questions as $question)
						<tr>
							<td>{{$question->created_at}}</td>
							<td><a href="/q-detail?id={{$question->id}}">{{$question->title}}</a></td>
							<td>{{$question->category}}</td>
							<td>{{$question->user->name}}</td>
						</tr>
					@endforeach()
				</table>
				<a href="/q-all">質問一覧</a>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col">
				<h2>質問作成フォーム</h2>
				@if(Auth::check())
					<table class="table">
						{{Form::open(['url' => '/question', 'method' => 'post'])}}
						{{Form::hidden('user_id', Auth::user()->id)}}
						{{Form::hidden('status', '質問中')}}
						<tr>
							<th>{{Form::label('title', 'タイトル')}}</th>
							<td>{{Form::text('title')}}</td>
						</tr>
						<tr>
							<th>{{Form::label('category', 'カテゴリー')}}</th>
							<td>{{Form::text('category')}}</td>
						</tr>
						<tr>
							<th>{{Form::label('body', '内容')}}</th>
							<td>{{Form::textarea('body')}}</td>
						</tr>
						<tr>
							<th></th>
							<td>{{Form::button('投稿!', ['type' => 'submit'])}}</td>
						</tr>
						{{Form::close()}}
					</table>
				@else
					<p>質問を作成するにはログインしてください！→<a href="/login">ログイン</a></p>
				@endif
			</div>
		</div>
	</div>

</section>

@endsection



	



	