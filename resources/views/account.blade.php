@extends('layouts.layout')
@section('title', 'Account')
@section('content')
<section id="account" class="py-4">
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h1 class="mb-3"><i class="far fa-user mr-3"></i>Account<small class="text-muted"> - アカウント</small></h1>
			</div>
		</div>
		<hr>
	</div>
	<!-- アカウント表示 -->
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h2 class="mb-3"><i class="fas fa-info-circle mr-3"></i>Information<small class="text-muted"> - アカウント情報</small></h2>
				<table class="table">
					<tr><th>ユーザ名</th><td>{{$user->name}}</td></tr>
					<tr><th>メールアドレス</th><td>{{$user->email}}</td></tr>
					<tr><th>パスワード</th><td>{{$user->password}}</td></tr>
					<tr><th>アカウント作成日時</th><td>{{$user->created_at}}</td></tr>
					<tr><th>アカウント更新日時</th><td>{{$user->updated_at}}</td></tr>
				</table>
				<a href="accountForm">アカウントを編集する</a>
			</div>
		</div>
	</div>
	<!-- 質問履歴表示 -->
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h2 class="mb-3"><i class="far fa-list-alt mr-3"></i>Question List<small class="text-muted"> - 質問履歴</small></h2>
				<table class="table">
					<tr>
						<th>
							<a href="account?questionSort=created_at">質問作成日</a>
						</th>
						<th>
							<a href="account?questionSort=title">質問タイトル</a>
						</th>
						<th>
							<a href="account?questionSort=category">カテゴリー</a>
						</th>
						<th>
							<a href="account?questionSort=status">ステータス</a>
						</th>
						<th></th>
						<th></th>
					</tr>
					@foreach($questions as $question)
					<tr>
						<td>{{$question->created_at}}</td>
						<td><a href="q-detail?id={{$question->id}}">{{$question->title}}</a></td>
						<td>{{$question->category}}</td>
						<td>{{$question->getquestionStatus($question->status)}}</td>
						<td><a href="questionForm?id={{$question->id}}">編集</a></td>
						<td>
							<!-- [質問中]であり回答を持たない質問のみ削除可 -->
							@if($question->status == 1 && $question->answer == '[]')
								<a href="questionDelete?id={{$question->id}}">削除</a>
							@endif
						</td>
					</tr>
					@endforeach
				</table>
				{{$questions->appends(['questionSort' => $question_sort])->links()}}
			</div>
		</div>
	</div>
	<!-- 回答履歴表示 -->
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h2 class="mb-3"><i class="fas fa-bullhorn mr-3"></i>Answer List<small class="text-muted"> - 回答履歴</small></h2>
				<table class="table">
					<tr>
						<th>
							<a href="account?answerSort=created_at">回答日</a>
						</th>
						<th>
							<a href="account?answerSort=title">回答タイトル</a>
						</th>
						<th>
							<a href="account?answerSort=question">質問</a>
						</th>
					</tr>
					@foreach($answers as $answer)
					<tr>
						<td>{{$answer->created_at}}</td>
						<td><a href="q-detail?id={{$answer->question_id}}#{{$answer->id}}">{{$answer->title}}</a></td>
						<td>{{$answer->question->title}}</td>
					</tr>
					@endforeach
				</table>
				{{$questions->appends(['answerSort' => $answer_sort])->links()}}
			</div>
		</div>
	</div>
</section>
@endsection