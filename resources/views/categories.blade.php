<!DOCTYPE html>
<html>
<head>
	<title>Главная</title>
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

<div class="main">
	<div class="row">
		<div class="row--small">

			<h2>Виды творчества</h2>

			@foreach($categories as $cat)
			<div class="driver grid">

				<div class="driver-left grid">
					<div class="driver-photo">
						<img src="{{ asset('img/driver1.png') }}">
					</div>

					<div class="driver-text">
						<div class="driver-name">
							{{ $cat->name }}
						</div>

						<div class="driver-desc">
							{{ $cat->description }}
						</div>
					</div>
				</div>

				<div class="driver-right">
					<a href="/category/{{ $cat->id }}" class="driver-btn">
						Перейти
					</a>
				</div>

			</div>
			@endforeach

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