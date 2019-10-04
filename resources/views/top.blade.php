@extends('layouts.layout')
@section('title', 'Top')
@section('content')
<section id="" class="py-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1>Topページ</h1>
				<p>DBリレーションを利用してQ&Aアプリの開発を行う</p>
				@if(count($errors) != 0)
					<p>{{$errors->first('id')}}</p>
				@endif
			</div>
		</div>
	</div>
</section>
@endsection

