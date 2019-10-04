@extends('layouts.layout')
@section('title', 'Top')
@section('content')
<section id="" class="py-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1>Detail - <small>質問詳細</small></h1>
				<p>個別の質問とそれに対する回答とコメントを表示する</p>
			</div>
		</div>
	</div>

	<div class="container">
		<h2>質問</h2>
		<div class="row">
			<div class="col-3">
				<p>質問者：{{$question->user->name}}</p>
			</div>
			<div class="col-9">
				<p>質問投稿日時：{{$question->created_at}}</p>
				<p>質問タイトル：{{$question->title}}</p>
				<p>質問内容：{{$question->body}}</p>
			</div>
		</div>
	</div>

	@if(isset($answers))
	<div class="container">
		<h2>回答</h2>
		@foreach($answers as $answer)
		<div class="row">
			<div class="col-3">
				<p>回答者：{{$answer->user->name}}</p>
			</div>

			<div class="col-9">
				<p>回答日時：{{$answer->created_at}}</p>
				<p>タイトル：{{$answer->title}}</p>
				<p>回答内容：{{$answer->body}}</p>

				<p>
					<button class="=btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseContent" aria-expanded="false" aria-controls="collapseContent">コメントを表示</button>
				</p>
				<div class="collapse" id="collapseContent">
					<div class="card">
						<div class="card-body">
							<h4>コメント</h4>
							@foreach($comments as $comment)
								@if($comment->answer_id == $answer->id)
									@if($comment->question->user_id == $question->user->id)
										<p>質問者：{{$comment->user->name}}さんのコメント</p>
										<p>コメント：{{$comment->body}}</p>
									@else
										<p>回答者：{{$comment->user->name}}さんのコメント</p>
										<p>コメント：{{$comment->body}}</p>
									@endif
								@endif
							@endforeach
							@if(Auth::check())
							<table class="table">
								{{Form::open(['url' => '/q-detail', 'method' => 'post'])}}
								{{Form::hidden('user_id', Auth::user()->id)}}
								{{Form::hidden('question_id', $answer->question_id)}}
								{{Form::hidden('answer_id', $answer->id)}}
								<tr>
									<th>{{Form::label('body', 'コメント')}}</th>
									<td>{{Form::textarea('body')}}</td>
								</tr>
								<tr>
									<th></th>
									<td>{{Form::button('コメントする！', ['type' => 'submit', 'name' => 'submit', 'value' => 'comment'])}}</td>
								</tr>
								{{Form::close()}}
							</table>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@else
	<div class="container">
		<h2>回答</h2>
		<div class="row">
			<div class="col">
				<p>まだ回答がありません</p>
			</div>
		</div>
	</div>
	@endif
	
	@if(Auth::check() && Auth::user()->id != $question->user->id)
	<div class="container">
		<h2>回答フォーム</h2>
		<div class="row">
			<div class="col">
				<p>質問に応えてみましょう！</p>
				<p>回答者：{{Auth::user()->name}}</p>
				<table class="table">
					{{Form::open(['url' =>'/q-detail', 'method' => 'post'])}}
					{{Form::hidden('user_id', Auth::user()->id)}}
					{{Form::hidden('question_id', $question->id)}}
					<tr>
						<th>{{Form::label('title', 'タイトル')}}</th>
						<td>{{Form::text('title')}}</td>
					</tr>
					<tr>
						<th>{{Form::label('body', '内容')}}</th>
						<td>{{Form::textarea('body')}}</td>
					</tr>
					<tr>
						<th></th>
						<td>{{Form::button('投稿する！', ['type' => 'submit', 'name' => 'submit', 'value' => 'answer'])}}</td>
					</tr>
					{{Form::close()}}
				</table>
			</div>
		</div>
	</div>
	@endif

</section>
@endsection
