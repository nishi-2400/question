<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
</head>
<header class="py-4 bg-dark text-light">
	<div class="container text-center">
		<h1><i class="fab fa-laravel mr-3"></i>Laravel - 質問掲示板</h1>
	</div>
	<ul class="nav nav-pills nav-justified jsutify-content-left">
		<li class="nav-item"><a class="nav-link text-light" href="/">Top</a></li>
		<li class="nav-item"><a class="nav-link text-light" href="/question">質問ページ</a></li>
		<li class="nav-item"><a class="nav-link text-light" href="/questionSearch">質問検索</a></li>
		@if(Auth::check())
			<li class="nav-item"><a class="nav-link text-light" href="/account">ユーザ情報</a></li>
			<li class="nav-item"><a class="nav-link text-light" href="/home">ログアウト</a></li>
		@else
			<li class="nav-item"><a class="nav-link text-light" href="/login">ログイン</a></li>
			<li class="nav-item"><a class="nav-link text-light" href="/register">アカウント登録</a></li>
		@endif
	</ul>
</header>
<body>
	@yield('content')
</body>
<footer class="py-4 bg-dark text-light">
	<div class="container text-center">
		<ul class="nav justify-content-center mb-3">
			<li class="nav-item"><a class="nav-link text-light" href="/">Top</a></li>
			<li class="nav-item"><a class="nav-link text-light" href="/question">質問ページ</a></li>
			<li class="nav-item"><a class="nav-link text-light" href="/questionSearch">質問検索</a></li>
		@if(Auth::check())
			<li class="nav-item"><a class="nav-link text-light" href="/account">ユーザ情報</a></li>
			<li class="nav-item"><a class="nav-link text-light" href="/home">ログアウト</a></li>
		@else
			<li class="nav-item"><a class="nav-link text-light" href="/login">ログイン</a></li>
			<li class="nav-item"><a class="nav-link text-light" href="/register">アカウント登録</a></li>
		@endif
		</ul>
		<p><i class="fab fa-laravel mr-2"></i><small>Laravel - 質問掲示板</small></p>
	</div>
</footer>
</html>