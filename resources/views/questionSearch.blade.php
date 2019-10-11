@extends('layouts.layout')
@section('title', 'Question Search')
@section('content')
<section id="" class="py-4">
	<div class="container py-4">
		<div class="row mb-4">
			<div class="col">
				<h1 class="mb-3"><i class="far fa-question-circle mr-3"></i>Quesiton Search<small class="text-muted"> - 質問検索</small></h1>
				<p>質問を検索してみよう！</p>
			</div>
		</div>
		<hr>
	</div>
	<!-- 検索フォーム表示 -->
	<div class="container py-4">
		<div class="row mb-4">
			<div class="col">
				<h2 class="mb-3"><i class="fas fa-search mr-3"></i>Search<small class="text-muted"> - 質問検索フォーム</small></h2>
				{{Form::open(['url' => 'questionSearch', 'method' => 'post'])}}
				{{Form::text('search', old('search'))}}
				{{Form::submit('検索', ['class' => 'btn btn-secondary'])}}
				{{Form::close()}}
			</div>
		</div>
	</div>
	<!-- 検索結果表示　デフォルトで最新記事 -->
	@if($questions)
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h2 class="mb-3"><i class="far fa-list-alt mr-3"></i>Question List<small class="text-muted"> - 質問一覧</small></h2>
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
				{{$questions->links()}}
			</div>
		</div>
	</div>
	@endif
	
</section>
@endsection

