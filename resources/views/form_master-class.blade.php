<!DOCTYPE html>
<html>
<head>
	<title>Form master class</title>
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

<div class="row row--nogutter top-line">
	<div class="line"></div>
</div>

<div class="main">
	<div class="row">
		<div class="row--small">

			<form method="POST" action="/master-class">
				@csrf

				<h2>Форма добавления мастер-класса</h2>

				@if ($errors->any())
					<div style="background:#ffdede; padding:10px; margin-bottom:15px; border:1px solid red;">
						<ul>
							@foreach ($errors->all() as $error)
								<li style="color:red;">{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<div class="form-group">
					<label>Вид творчества</label>
					<select name="category_id">
						@foreach($categories as $cat)
							<option value="{{ $cat->id }}"
								{{ old('category_id') == $cat->id ? 'selected' : '' }}>
								{{ $cat->name }}
							</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label>Название</label>
					<input type="text" name="title"
						value="{{ old('title') }}"
						class="@error('title') error @enderror">

					@error('title')
						<div style="color:red;">{{ $message }}</div>
					@enderror
				</div>

				<div class="form-group">
					<label>Описание мастер-класса</label>
					<textarea name="description"
						class="@error('description') error @enderror">{{ old('description') }}</textarea>

					@error('description')
						<div style="color:red;">{{ $message }}</div>
					@enderror
				</div>

				<div class="form-group">
					<label>Дата</label>
					<input type="date" name="date"
						value="{{ old('date') }}">

					@error('date')
						<div style="color:red;">{{ $message }}</div>
					@enderror
				</div>

				<div class="form-group">
					<label>Время</label>
					<select name="time">
						@foreach(['09:00','11:00','13:00','15:00'] as $time)

							@php
								$isBusy = isset($busy[old('date')]) && in_array($time, $busy[old('date')]);
							@endphp

							<option value="{{ $time }}"
								{{ old('time') == $time ? 'selected' : '' }}
								{{ $isBusy ? 'disabled' : '' }}
								style="{{ $isBusy ? 'color:red;' : '' }}"
							>
								{{ $time }} {{ $isBusy ? '(занято)' : '' }}
							</option>

						@endforeach
					</select>

					@error('time')
						<div style="color:red;">{{ $message }}</div>
					@enderror
				</div>

				<div class="form-group">
					<label>Количество человек</label>
					<input type="number" name="max_people"
						value="{{ old('max_people') }}">

					@error('max_people')
						<div style="color:red;">{{ $message }}</div>
					@enderror
				</div>

				<div class="form-group">
					<label>Цена</label>
					<input type="number" name="price"
						value="{{ old('price') }}">

					@error('price')
						<div style="color:red;">{{ $message }}</div>
					@enderror
				</div>

				<div class="form-group">
					<button class="btn">Отправить</button>
				</div>

			</form>

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