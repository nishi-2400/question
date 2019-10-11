@extends('layouts.layout')
@section('title', 'Account Form')
@section('content')
<section id="accountForm" class="py-4">
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h1 class="mb-3"><i class="far fa-user mr-3"></i>Account Edit<small class="text-muted"> - アカウント編集</small></h1>
			</div>
		</div>
		<hr>
	</div>
	<!-- アカウント編集フォーム -->
	<div class="container py-4">
		<div class="row">
			<div class="col">
				<h2 class="mb-3"><i class="fas fa-info-circle mr-3"></i>Edit<small class="text-muted"> - 編集</small></h2>
				{{ Form::open(['url' => '/accountEdit', 'method' => 'post']) }}
				<table class="table">
					<tr>
						<th>{{ Form::label('name', 'ユーザ名') }}</th>
						<td>
							{{Form::text('name', $user->name, ['class' => 'user_name'])}}
							@if($errors->any())
								{{$errors->first('name')}}
							@endif
						</td>
					</tr>
					<tr>
						<th>{{ Form::label('mail', 'メール') }}</th>
						<td>
							{{Form::text('mail', $user->email, ['class' => 'user_mail']) }}
							@if($errors->any())
								{{$errors->first('mail')}}
							@endif
						</td>
					</tr>
					<tr>
						<th>{{ Form::label('password', 'パスワード') }}</th>
						<td>
							{{Form::password('password', ['class' => 'user_passward']) }}
							@if($errors->any())
								{{$errors->first('password')}}
							@endif
						</td>
					</tr>

					<tr>
						<th></th>
						<td>{{ Form::button('確認', ['type' => 'button', 'class' => 'btn btn-secondary modalClass', 'data-toggle' => 'modal', 'data-target' => '#modal'])}}</td>
					</tr>
					
					<!-- フォーム確認用モーダル -->
					<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labbeledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title px-3 bg-warning" id="exampleModal"><i class="fas fa-exclamation-triangle mr-3"></i>下記の内容でアカウントを更新します</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<h5 class="bg-light">【ユーザ名】</h5>
									<p class="modal-user_name"></p>
									<h5 class="bg-light">【メールアドレス】</h5>
									<p class="modal-user_mail"></p>
									<h5 class="bg-light">【パスワード】</h5>
									<p class="modal-user_password"></p>
								</div>
								<div class="modal-footer">
									{{Form::button('更新', ['type' => 'submit', 'class' => 'btn btn-secondary'])}}
								</div>
							</div>
						</div>
					</div>
				</table>
				{{ Form::close() }}
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
        user_name = $(".user_name").val();
        user_mail = $(".user_mail").val();
        user_passward = $(".user_passward").val();

        //取得した値モーダル内で表示
        $(".modal-user_name").text(user_name);
        $(".modal-user_mail").text(user_mail);
        $(".modal-user_password").text(user_passward);
    });
});
</script>
@endsection