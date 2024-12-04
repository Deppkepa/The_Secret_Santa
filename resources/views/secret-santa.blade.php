<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Тайный Санта</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@include('header')
    <div class="form-container">
        <h3>Заполните форму участника</h3>
        <form action="{{ route('secret-santa.store') }}" method="POST"> 
            @csrf 
            <div> 
                <label for="name">Ваше имя</label> 
                <input type="text" id="name" name="name" required> 
                @error('name') 
                    <div class="text-danger">{{ $message }}</div> 
                @enderror 
            </div> 
            <div> 
                <label for="email">Ваш Email</label> 
                <input type="email" id="email" name="email" required> 
                @error('email') 
                    <div class="text-danger">{{ $message }}</div> 
                @enderror 
            </div> 
            <div> 
                <label for="description">Ваши пожелания к подарку</label> 
                <input type="description" id="description" name="description" required> 
                @error('description') 
                    <div class="text-danger">{{ $message }}</div> 
                @enderror 
            </div> 
            <button type="submit">Зарегистрироваться</button> 
        </form> 
    </div>
    @if(session('success'))
        <div class="okno">
            {{ session('success') }}
        </div>
    @endif
@include('footer') 
</body>
</html>
