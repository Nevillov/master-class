<!DOCTYPE html>
<html>
<head>
    <title>Редактировать</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<div class="main">
    <div class="row">
        <div class="row--small">

            <h2>Редактирование</h2>

            <form method="POST" action="/master-class/{{ $mc->id }}/update">
                @csrf

                <div>
                    <label>Категория</label>
                    <select name="category_id">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ $mc->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Название</label>
                    <input name="title" value="{{ $mc->title }}">
                </div>

                <div>
                    <label>Описание</label>
                    <textarea name="description">{{ $mc->description }}</textarea>
                </div>

                <div>
                    <label>Дата</label>
                    <input type="date" name="date" value="{{ $mc->date }}">
                </div>

                <div>
                    <label>Время</label>
                    <input name="time" value="{{ $mc->time }}">
                </div>

                <div>
                    <label>Люди</label>
                    <input name="max_people" value="{{ $mc->max_people }}">
                </div>

                <div>
                    <label>Цена</label>
                    <input name="price" value="{{ $mc->price }}">
                </div>

                <button>Сохранить</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>