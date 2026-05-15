<!DOCTYPE html>
<html>
<head>
    <title>Подтверждение записи</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<div class="header">
    <div class="row grid middle between">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}">
        </div>
        <div class="title">
            Подтверждение записи
        </div>
        <div class="auth">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button style="background:none;border:none;cursor:pointer;">
                    Выход
                </button>
            </form>

        </div>
    </div>
</div>

<div class="main">
    <div class="row">
        <div class="row--small">

            <h2>Подтверждение записи</h2>

            @if ($errors->any())
                <div style="color:red;">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div style="border:1px solid #ccc; padding:15px; margin-bottom:20px;">

                <p><b>ФИО пользователя:</b> {{ auth()->user()->name }}</p>

                <p><b>Вид творчества:</b> {{ $mc->category->name }}</p>

                <p><b>Мастер:</b> {{ $mc->user->name }}</p>

                <p><b>Дата:</b> {{ $mc->date }}</p>

                <p><b>Время:</b> {{ $mc->time }}</p>

            </div>

            <form method="POST" action="{{ route('register.store', $mc->id) }}">
                @csrf
                <button class="btn">Подтвердить</button>
            </form>

            <br>

            <a href="/category/{{ $mc->category_id }}" class="btn">
                Отмена
            </a>

        </div>
    </div>
</div>

</body>
</html>