@extends('layouts.layout')
@section('title', 'Account')
@section('content')
<section id="" class="py-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1>Account - <small>アカウント情報</small></h1>
				<p>【{{Auth::user()->name}}】さんのアカウント情報</p>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col">
				<h2>アカウント情報</h2>
				<table class="table">
					<tr><th>ユーザ名</th><td>{{$user->name}}</td></tr>
					<tr><th>メールアドレス</th><td>{{$user->email}}</td></tr>
					<tr><th>アカウント作成日時</th><td>{{$user->created_at}}</td></tr>
				</table>
				<a href="">アカウントを編集する</a>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col">
				<h2>質問履歴</h2>
				<table class="table">
					<tr><th>質問作成日</th><th>質問タイトル</th><th>カテゴリー</th><th>ステータス</th><th></th></tr>
					@foreach($questions as $question)
					<tr>
						<td>{{$question->created_at}}</td>
						<td><a href="/q-detail?id={{$question->id}}">{{$question->title}}</a></td>
						<td>{{$question->category}}</td>
						<td>{{$question->status}}</td>
						<td><a href="">編集</a></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col">
				<h2>回答履歴</h2>
				<table class="table">
					<tr><th>回答日</th><th>回答タイトル</th><th>質問</th></tr>
					@foreach($answers as $answer)
					<tr>
						<td>{{$answer->created_at}}</td>
						<td><a href="/q-detail?id={{$answer->question_id}}">{{$answer->title}}</a></td>
						<td><a href="/q-detail?id={{$answer->question_id}}">{{$answer->question->title}}</a></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</section>
@endsection
