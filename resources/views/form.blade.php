@extends('index')

@section('content')

<div class="card">
    <div class="form-group md-4">
        <form method="POST" action="/">
            {{ csrf_field() }}
            <input class="form-control" type="text" name="link" placeholder="Введите URL">
            <button class="btn btn-success" type="submit">Сгенерировать короткую ссылку</button>
        </form>
        @if ($url)
        <a href='{{ $url }}'>{{ $url }}</a>
        @endif
    </div>
</div>

@endsection
