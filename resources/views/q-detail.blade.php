@extends('layouts.layout')
@section('title', 'Question Detail')
@section('content')
<section id="" class="py-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1 class="mb-3"><i class="fas fa-book-open mr-3"></i>Question Detail - <small class="text-muted">質問詳細</small></h1>
			</div>
		</div>
		<hr>
	</div>
	<!-- 質問エリア -->
	<div class="container py-4">
		<div class="row media mb-3 py-3 border rounded">
			<div class="col-2 order-1">
				<h3 class="align-self-start"><i class="far fa-question-circle mr-3"></i>質問</h3>
				<p class="bg-primary text-light"><i class="far fa-user mx-2"></i>質問者：{{$question->user->name}}</p>
				<p>アバター画像挿入(予定)</p>
			</div>
			<div class="col-8 media-body order-2">
				<ul class="list-inline">
					<li class="list-inline-item">質問タイトル：{{$question->title}}</li>
					<li class="list-inline-item">質問投稿日時：{{$question->created_at}}</li>
					<li class="list-inline-item">質問更新日時：{{$question->updated_at}}</li>
				</ul>
				<p>【質問内容】</p>
				<p>{!!$question->body!!}</p>
				<!-- 質問編集 質問制作者の場合表示 -->
				@if(Auth::check())
					@if(Auth::user()->id == $question->user_id)
						<a href="/questionForm?id={{$question->id}}&from=q-detail">質問を編集する</a>
					@endif
				@endif
			</div>
		
			<div class="col-2 order-3">
				Question
			</div>
		</div>
	</div>

	<!-- 質問のステータスが[2:解決済み] -->
	@if($question->status == 2)
		<div class="container py-4">
			<div class="row">
				<div class="col">
					<h2 class="text-center bg-warning"><i class="fas fa-exclamation-triangle mr-2"></i>この質問は解決しました。ご協力ありがとうございました。</h2>
				</div>
			</div>
		</div>
		<!-- 回答表示 -->
		<div class="container py-4">
			@foreach($answers as $answer)
			<div class="row media mb-4 py-3 border rounded">
				<div class="col-2 order-3">
					<h2 id="{{$answer->id}}" class=""><i class="fas fa-bullhorn mr-3"></i>回答</h2>
					<p class="bg-danger text-light"><i class="fas fa-user-graduate mx-2"></i>回答者：{{$answer->user->name}}</p>
					<p><i class="far fa-user-circle mr-2"></i>アバター画像挿入(予定)</p>
				</div>

				<div class="col-8 media-body order-2">
					<ul class="list-inline">
						<li class="list-inline-item">回答タイトル：{{$answer->created_at}}</li>
						<li class="list-inline-item">回答投稿日時：{{$answer->title}}</li>
					</ul>
					<p>【回答内容】</p>
					<p>{{$answer->body}}</p>
					<p>
						<button class="=btn btn-secondary" type="button" data-toggle="collapse" data-target="#comment_{{$answer->id}}" aria-expanded="false" aria-controls="collapseContent">コメントを表示</button>
					</p>

					<!-- コメント表示 -->
					<div class="collapse" id="comment_{{$answer->id}}">
						<div class="card">
							<div class="card-body">
								<h3 class="mb-3"><i class="far fa-comments mr-3"></i>コメント</h4>
								@foreach($comments as $comment)
									@if($comment->answer_id == $answer->id)
										@if($comment->user_id == $question->user->id)
										<div class="card my-3">
											<p>質問者：{{$comment->user->name}}さんのコメント</p>
											<div class="card-body">
												<p>コメント：{{$comment->body}}</p>
											</div>
										</div>
										@elseif($comment->user_id == $answer->user_id)
											<div class="card my-3">
												<p>回答者：{{$comment->user->name}}さんのコメント</p>
												<div class="card-body">
													<p>コメント：{{$comment->body}}</p>
												</div>
											</div>
										@else
											<div class="card my-3">
												<p>その他の回答者：{{$comment->user->name}}さんのコメント</p>
												<div class="card-body">
													<p>コメント：{{$comment->body}}</p>
												</div>
											</div>
										@endif
									@endif
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<!-- ベストアンサー表示 -->
				<div class="col-2 order-1">
					<p>Answer</p>
					@if($answer->status == 2)
						<p class="bg-danger text-light text-center">ベストアンサー</p>
						<!-- ベストアンサーの解除 質問制作者の場合表示 -->
						@if(Auth::check())
							@if(Auth::user()->id == $question->user_id)
								<small><a href="q-detail?id={{$question->id}}&bestAnswerReset={{$answer->id}}">ベストアンサーを解除する</a></small>
							@endif
						@endif
					@endif
				</div>
			</div>
			@endforeach
		</div>
	<!-- 質問のステータスが[1:質問中]-->
	@else
		<!-- 回答なし-->
		@if(empty($answers))
			@if(Auth::check())
				@if(Auth::user()->id == $question->user_id)
					<div class="container py-4">
						<div class="row">
							<div class="col">
								<h2><i class="fas fa-bullhorn mr-3"></i>Answer<small class="text-muted"> - 回答</small></h2>
								<p>まだ回答がありません。気長に待ちましょう...。</p>
							</div>
						</div>
					</div>
				@endif
			@endif
		@else
		<!-- 回答あり 回答表示-->
			<div class="container py-4">
				@foreach($answers as $answer)
					<div class="row media mb-4 py-3 border rounded">
						<div class="col-2 order-3">
							<h2 id="{{$answer->id}}" class="align-self-start"><i class="fas fa-bullhorn mr-3"></i>回答</h2>
							<p class="bg-danger text-light"><i class="fas fa-user-graduate mx-2"></i>回答者：{{$answer->user->name}}</p>
							<p><img src="">アバター画像挿入(予定)</p>
						</div>

						<div class="col-8 media-body order-2">
							<ul class="list-inline">
								<li class="list-inline-item">回答タイトル：{{$answer->title}}</li>
								<li class="list-inline-item">回答投稿日時：{{$answer->created_at}}</li>
							</ul>
							<p>【回答内容】</p>
							<p>{{$answer->body}}</p>
					
							<p>
								<button class="=btn btn-secondary" type="button" data-toggle="collapse" data-target="#comment_{{$answer->id}}" aria-expanded="false" aria-controls="collapseContent">コメントを表示</button>
							</p>	
						
							<!-- コメントエリア -->
							<div class="collapse" id="comment_{{$answer->id}}">
								<div class="card">
									<div class="card-body">
										<h3 class="mb-3"><i class="far fa-comments mr-2"></i>コメント</h3>
										<!-- コメント表示-->
										@foreach($comments as $comment)
											@if($comment->answer_id == $answer->id)
												@if($comment->user_id == $question->user->id)
												<div class="card my-3">
													<p>質問者：{{$comment->user->name}}さんのコメント</p>
													<div class="card-body">
														<p>コメント：{{$comment->body}}</p>
													</div>
												</div>
												@elseif($comment->user_id == $answer->user_id)
												<div class="card my-3">
													<p>回答者：{{$comment->user->name}}さんのコメント</p>
													<div class="card-body">
														<p>コメント：{{$comment->body}}</p>
													</div>
												</div>
												@else
												<div class="card my-3">
													<p>その他の回答者：{{$comment->user->name}}さんのコメント</p>
													<div class="card-body">
														<p>コメント：{{$comment->body}}</p>
													</div>
												</div>
												@endif
											@endif
										@endforeach

										<!-- コメントフォーム ログインしている場合表示-->
										@if(Auth::check())
											{{Form::open(['url' => 'q-detail', 'method' => 'post'])}}
											{{Form::hidden('user_id', Auth::user()->id)}}
											{{Form::hidden('question_id', $answer->question_id)}}
											{{Form::hidden('answer_id', $answer->id)}}
											<table class="table">
												<tr>
													<th>{{Form::label('body', 'コメント')}}</th>
													<td>{{Form::textarea('body')}}</td>
												</tr>
												<tr>
													<th></th>
													<td>{{Form::submit('コメント', ['type' => 'submit', 'class' => 'btn btn-secondary', 'name' => 'submit', 'value' => 'comment'])}}</td>
												</tr>
											</table>
											{{Form::close()}}
										@else
											<p>コメントするにはログインが必要です→<a href="login">ログイン</a></p>
										@endif
									</div>
								</div>
							</div>
						</div>

						<div class="col-2 order-1">
							<p>Answer</p>
							<!-- ベストアンサーの選択 質問制作者の場合表示 -->
							@if(Auth::check())
								@if(Auth::user()->id == $question->user_id)
									<a href="q-detail?id={{$question->id}}&bestAnswer={{$answer->id}}">ベストアンサーに選ぶ</a>
								@endif
							@endif
						</div>
					</div>
				@endforeach
			</div>
		@endif
		<!-- 回答フォームの表示-->
		<!-- ログイン中-->
		@if(Auth::check())
			@if(Auth::user()->id != $question->user->id)
				<div class="container py-4">
					<h2><i class="fas fa-pencil-alt mr-3"></i>Answer Form - <small class="text-muted">回答フォーム</small></h2>
					<p>質問に応えてみましょう！</p>
					<div class="row">
						<div class="col">
							{{Form::open(['url' =>'q-detail', 'method' => 'post'])}}
							{{Form::hidden('user_id', Auth::user()->id)}}
							{{Form::hidden('question_id', $question->id)}}
							<!-- 1：ノーマル / 2：ベストアンサー -->
							{{Form::hidden('status', 1)}}
							<table class="table">
								<tr>
									<th>回答者</th>
									<td>{{Auth::user()->name}}</td>
								</tr>
								<tr>
									<th>{{Form::label('title', 'タイトル')}}</th>
									<td>
										{{Form::text('title', old('title'), ['class' => 'a-title'])}}
										@if(count($errors) != 0)
											{{$errors->first('title')}}
										@endif
									</td>
								</tr>
								<tr>
									<th>{{Form::label('body', '内容')}}</th>
									<td>
										{{Form::textarea('body', old('body'), ['class' => 'a-body'])}}
										@if(count($errors) != 0)
											{{$errors->first('body')}}
										@endif
									</td>
								</tr>
								<tr>
									<th></th>
									<td>{{Form::button('確認', ['type' => 'button', 'class' => 'btn btn-secondary modalClass', 'data-toggle' => 'modal', 'data-target' => '#modal'])}}</td>
								</tr>

								<!-- 回答フォームの入力確認表示-->
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labbeledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title px-3 bg-warning" id="exampleModal"><i class="fas fa-exclamation-triangle mr-3"></i>下記の内容で回答を作成します</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<h5 class="bg-light">【タイトル】</h5>
												<p class="a-modal-title"></p>
												<h5 class="bg-light">【内容】</h5>
												<p class="a-modal-body"></p>
											</div>
											<div class="modal-footer">
												{{Form::submit('回答', ['name' => 'submit', 'class' => 'btn btn-secondary'])}}
											</div>
										</div>
									</div>
								</div>
							</table>
							{{Form::close()}}
						</div>
					</div>
				</div>
			@endif
		<!-- ログインしていない-->
		@else
			<div class="container py-4">
				<div class="row">
					<div class="col">
						<h2><i class="fas fa-pencil-alt mr-3"></i>Answer Form - <small class="text-muted">回答フォーム</small></h2>
						<p>質問に応えてみましょう！</p>
						<p>回答するにはログインが必要です→<a href="login">ログイン</a></p>
						<p>アカウント登録はこちら→<a href="register">登録</a></p>
					</div>
				</div>
			</div>
		@endif
	@endif
</section>

<!-- 回答フォームの入力確認表示エフェクト -->
<script type="text/javascript">
$(document).ready(function(){
    // ボタンをクリックした場合
    $(".modalClass").click(function () {
        // フォームの値を取得
        title = $(".a-title").val();
        body = $(".a-body").val();

        //取得した値モーダル内で表示
        $(".a-modal-title").text(title);
        $(".a-modal-body").text(body);
    });
});
</script>
@endsection