<!DOCTYPE html>
<html>
<head>
	<title>Cabinet</title>
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>
<body class="dp">

<div class="header">
	<div class="row grid middle between">
		<div class="logo">
			<img src="{{ asset('img/logo.png') }}">
		</div>
		<div class="title">
			Клуб любителей творчества «ОчУмелые ручки»
		</div>
		<div class="auth">
			<form method="POST" action="{{ route('logout') }}">
				@csrf
				<button type="submit">Выйти</button>
			</form>
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
		<div class="title"></div>

		<div class="row--small grid between">

			<div class="content driver-page">

				<div class="driver-page-photo">
					<img src="{{ asset('img/driver-page.png') }}">
				</div>	

				<div class="driver-page-name">
					{{ auth()->user()->name }}
				</div>

				@if(session('success'))
					<div style="background:#d4ffd4; padding:10px; margin:10px 0;">
						{{ session('success') }}
					</div>
				@endif

				<div class="driver-page-text">
					<div class="driver-page-my">Мои мастер-классы</div>

					<table class="driver-page-table">
						<tbody>

						@forelse($masterClasses as $mc)
							<tr>
								<td>{{ $mc->date }} {{ $mc->time }}</td>
								<td>

									<b>{{ $mc->title }}</b>

									@if($mc->registrations->count() == 0)
										<p>Нет записей</p>
									@else
										@foreach($mc->registrations as $i => $reg)
											<p>
												{{ $i+1 }}. {{ $reg->user->name ?? 'Пользователь' }} <br>
												email: {{ $reg->user->email ?? '-' }} <br>
												tel: {{ $reg->user->phone ?? '-' }}
											</p>
										@endforeach
									@endif

									<div style="margin-top:10px;">
										<a href="/master-class/{{ $mc->id }}/edit" class="btn">
											Редактировать
										</a>

										<form method="POST"
											action="/master-class/{{ $mc->id }}/delete"
											style="display:inline;">
											@csrf
											<button class="btn"
												onclick="return confirm('Удалить?')">
												Удалить
											</button>
										</form>
									</div>

								</td>
							</tr>
						@empty
							<tr>
								<td colspan="2">У вас пока нет мастер-классов</td>
							</tr>
						@endforelse

						</tbody>
					</table>
				</div>

				<div class="driver-page-btn-wrapper">
					<a href="/form-master-class" class="driver-page-btn btn">
						Добавить мастер-класс
					</a>
				</div>

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
	</div>	
</div>

<div class="row row--nogutter">
	<div class="line"></div>
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