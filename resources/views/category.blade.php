<!DOCTYPE html>
<html>
<head>
	<title>Category</title>
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>
<body>

<div class="header">
	<div class="row grid middle between">
		<div class="logo">
			<img src="{{ asset('img/logo.png') }}">
		</div>
		<div class="title">
			Клуб любителей творчества «ОчУмелые ручки»
		</div>
		<div class="auth">

			@auth

				@if(auth()->user()->role === 'master')
					<a href="/cabinet">Кабинет</a>
				@endif

				<form method="POST" action="{{ route('logout') }}" style="display:inline;">
					@csrf
					<button style="background:none;border:none;cursor:pointer;">
						Выход
					</button>
				</form>

			@else
				<a href="/login">Вход</a>
			@endauth

		</div>
	</div>
</div>

<div class="row row--nogutter">
	<div class="menu-burger">
		<div class="burger">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>	
</div>

<div class="main">
	<div class="row">

		<div class="hover"></div>

		<div class="title">
			{{ $category->name }}
		</div>

		<div class="row--small grid between">

			<div class="content">
				<img src="{{ asset('img/elifant.png') }}">
				<p>{{ $category->description }}</p>
			</div>

			<ul class="menu">
				@foreach(\App\Models\Category::all() as $cat)
					<li>
						<a href="/category/{{ $cat->id }}">
							{{ $cat->name }}
						</a>
					</li>
				@endforeach
			</ul>

		</div>

		<div class="row shedule">
			<div class="row--small">
				<h2>Расписание</h2>

				@if(session('error'))
					<div style="color:red; margin-bottom:10px;">
						{{ session('error') }}
					</div>
				@endif

				@if(session('success'))
					<div style="color:green; margin-bottom:10px;">
						{{ session('success') }}
					</div>
				@endif

				<div class="drivers">

					@foreach($masterClasses as $mc)
					<div class="driver grid">

						<div class="driver-left grid">
							<div class="driver-photo">
								<img src="{{ asset('img/driver1.png') }}">
							</div>

							<div class="driver-text">
								<div class="driver-name">
									{{ $mc->user->name ?? 'Мастер' }}
								</div>

								<div class="driver-desc">
									{{ $mc->description }}
								</div>
							</div>
						</div>

				<div class="driver-right">

					@php
						$isFull = $mc->registrations->count() >= $mc->max_people;

						$isRegistered = auth()->check() &&
							\App\Models\Registration::where('user_id', auth()->id())
								->where('master_class_id', $mc->id)
								->exists();
					@endphp


					@if($isFull)
						<div style="color:red;">Нет мест</div>

					@elseif($isRegistered)
						<div style="color:orange;">Вы уже записаны</div>

					@else

						@auth
							@if(auth()->user()->role === 'user')
								<form method="GET" action="{{ route('register.confirm', $mc->id) }}">
									<button class="driver-btn">Записаться</button>
								</form>
							@endif
						@endauth

					@endif

					<div class="driver-time">
						{{ $mc->date }} {{ $mc->time }}
					</div>

				</div>	

					</div>
					@endforeach

				</div>
			</div>
		</div>

	</div>	
</div>

<div class="footer">
	<div class="row">
		<div class="row--small grid between">
			<div class="address">Наш адрес: ВДНХ, 120в</div>
			<div class="tel">Тел: 89123456765</div>
			<div class="copy">(с) Copyright, 2017</div>
		</div>
	</div>
</div>

</body>
</html>