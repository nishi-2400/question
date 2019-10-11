@extends('layouts.layout')
@section('title', 'Question Form')
@section('content')
<section id="" class="py-4">
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h1 class="mb-3"><i class="far fa-question-circle mr-3"></i>Quesiton Edit<small class="text-muted"> - 質問編集</small></h1>
			</div>
		</div>
		<hr>
	</div>
	<!-- 編集フォーム-->
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h2 class="mb-3"><i class="far fa-edit mr-3"></i>Edit<small  class="text-muted"> - 編集</small></h2>
				<!-- 編集処理後の表示 -->
				@if(isset($msg))
					<p>{{$msg}}<a href="q-detail?id={{$question->id}}">質問ページで確認する</a></p>
				@endif
				{{Form::open(['url' => 'questionForm', 'method' => 'post'])}}
				{{Form::hidden('id', $question->id)}}
				<table class="table">
				    <tr>
				        <th>{{Form::label('title', 'タイトル')}}</th>
				        <td>
				        	{{Form::text('title', $question->title, ['class' => 'q-title'])}}
				        	@if($errors->any())
								{{$errors->first('title')}}
							@endif
				        </td>
				    </tr>
				    <tr>
				        <th>{{Form::label('category', 'カテゴリー')}}</th>
				        <td>
				        	{{Form::text('category', $question->category, ['class' => 'q-category'])}}
				        	@if($errors->any())
								{{$errors->first('category')}}
							@endif
				        </td>
				    </tr>
				    <tr>
				        <th>{{Form::label('body', '内容')}}</th>
				        <td>
				        	{{Form::textarea('body', $question->body, ['class' => 'q-body'])}}
				        	@if($errors->any())
								{{$errors->first('body')}}
							@endif
				        </td>
				    </tr>
				    <!-- ステータスが[1:質問中の場合] -->
				    @if($question->status == 1)
				    	<tr>
				    		<th>{{Form::label('status', 'ステータス')}}</th>
				    		<td>
				    			{{Form::select('status', [1 => '質問中'], $question->getquestionStatus($question->status), ['class' => 'q-status', 'disabled'] )}}
				    			<p class="pt-2 mb-0"><a href="q-detail?id={{$question->id}}">ベストアンサー選ぶ</a></p>
				    		</td>
				    	</tr>
				    	
				    @else
				    	<tr>
					        <th>{{Form::label('status', 'ステータス')}}</th>
					        <td>
					        	{{Form::select('status', [1 => '質問中', 2 => '解決済み'], $question->status, ['class' => 'q-status'])}}
					        	@if($errors->any())
									{{$errors->first('status')}}
								@endif
					        </td>
					    </tr>
				    @endif
				    <tr>
						<th></th>
						<td>{{Form::button('確認', ['type' => 'button', 'class' => 'btn btn-secondary modalClass', 'data-toggle' => 'modal', 'data-target' => '#modal'])}}</td>
					</tr>

					<!-- フォーム確認用モーダル -->
					<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labbeledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title px-3 bg-warning" id="exampleModal"><i class="fas fa-exclamation-triangle mr-3"></i>下記の内容で質問を更新します</h5>
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
									<h5 class="bg-light">【ステータス】</h5>
									<p class="q-modal-status"></p>
								</div>
								<div class="modal-footer">
									{{Form::button('更新', ['type' => 'submit', 'class' => 'btn btn-secondary'])}}
								</div>
							</div>
						</div>
					</div>
				</table>
				{{Form::close()}}
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
        status = $(".q-status").val();

        //取得した値モーダル内で表示
        $(".q-modal-title").text(title);
        $(".q-modal-category").text(category);
        $(".q-modal-body").text(body);
        $(".q-modal-status").text(status);
    });
});
</script>
@endsection