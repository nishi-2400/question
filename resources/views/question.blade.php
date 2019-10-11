@extends('layouts.layout')
@section('title', 'Question')
@section('content')
<section id="" class="py-4">
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h1 class="mb-3"><i class="far fa-question-circle mr-3"></i>Quesiton<small class="text-muted"> - 質問ページ</small></h1>
				<p>解らないことは誰かに聞いてみましょう！！</p>
			</div>
		</div>
		<hr>
	</div>
	<!-- 質問検索フォーム-->
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h2 class="mb-3"><i class="fas fa-search mr-3"></i>Search<small class="text-muted"> - 質問検索フォーム</small></h2>
				{{Form::open(['url' => 'questionSearch', 'method' => 'post'])}}
				{{Form::text('search', old('search'))}}
				{{Form::submit('検索', ['class' => 'btn btn-secondary'])}}
				{{Form::close()}}
			</div>
		</div>
	</div>
	<!-- 最新の質問-->
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h2 class="mb-3"><i class="far fa-list-alt mr-3"></i>New<small class="text-muted"> - 最新の質問</small></h2>
				<table class="table">
					<tr><th>日時</th><th>質問タイトル</th><th>カテゴリー</th><th>質問者</th></tr>
					@foreach($questions as $question)
						<tr>
							<td>{{$question->created_at}}</td>
							<td><a href="q-detail?id={{$question->id}}">{{$question->title}}</a></td>
							<td>{{$question->category}}</td>
							<td>{{$question->user->name}}</td>
						</tr>
					@endforeach()
				</table>
				{{$questions->links()}}
			</div>
		</div>
	</div>
	<!-- 質問フォーム-->
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h2 class="mb-3"><i class="fas fa-pencil-alt mr-3"></i>Question Form<small class="text-muted"> - 質問作成フォーム</small></h2>
				<!-- ログインしている場合表示-->
				@if(Auth::check())
					{{Form::open(['url' => 'question', 'method' => 'post'])}}
					{{Form::hidden('user_id', Auth::user()->id)}}
					<!-- 1：質問中 / 2：解決済み -->
					{{Form::hidden('status', 1)}}
					<table class="table">	
						<tr>
							<th>{{Form::label('title', 'タイトル')}}</th>
							<td>
								{{Form::text('title', old('title'), ['class' => 'q-title'])}}
								@if($errors->any())
									{{$errors->first('title')}}
								@endif
							</td>
						</tr>
						<tr>
							<th>{{Form::label('category', 'カテゴリー')}}</th>
							<td>
								{{Form::text('category', old('category'), ['class' => 'q-category'])}}
								@if($errors->any())
									{{$errors->first('category')}}
								@endif
							</td>
						</tr>
						<tr>
							<th>{{Form::label('body', '内容')}}</th>
							<td>
								{{Form::textarea('body', old('body'), ['class' => 'q-body'])}}
								@if($errors->any())
									{{$errors->first('body')}}
								@endif
							</td>
						</tr>
						<tr>
							<th></th>
							<td>{{Form::button('確認', ['type' => 'button', 'class' => 'btn btn-secondary modalClass', 'data-toggle' => 'modal', 'data-target' => '#modal'])}}</td>
						</tr>
						<!-- フォーム確認用モーダル -->
						<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labbeledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title px-3 bg-warning" id="exampleModal"><i class="fas fa-exclamation-triangle mr-3"></i>下記の内容で質問を作成します</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<h5 class="bg-light">【タイトル】</h5>
										<p class="q-modal-title"></p>
										<h5 class="bg-light">【カテゴリー】</h5>
										<p class="q-modal-category"></p>
										<h5 class="bg-light">【内容】</h5>
										<p class="q-modal-body"></p>
									</div>
									<div class="modal-footer">
										{{Form::button('投稿', ['type' => 'submit', 'class' => 'btn btn-secondary'])}}
									</div>
								</div>
							</div>
						</div>
					</table>
					{{Form::close()}}
				@else
					<p>質問を作成するにはログインしてください！→<a href="/login">ログイン</a></p>
				@endif
			</div>
		</div>
	</div>
</section>

<!-- フォーム確認用モーダル エフェクト-->
<script type="text/javascript">
$(document).ready(function(){
    // ボタンをクリックした場合
    $(".modalClass").click(function () {
        // フォームの値を取得
        title = $(".q-title").val();
        category = $(".q-category").val();
        body = $(".q-body").val();

        //取得した値モーダル内で表示
        $(".q-modal-title").text(title);
        $(".q-modal-category").text(category);
        $(".q-modal-body").text(body);
    });
});
</script>
@endsection