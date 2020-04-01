<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShortLink;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

class ShortenerController extends Controller {

    public function save(Request $request) {

        //Валидация полученного URL
        $request->validate([
            'link' => 'required|url'
        ]);
        $data['link'] = $request->link;

        //Генерация токена длинной 6 символов
        $data['code'] = $this->generateCode(6);

        //Сохранение модели в БД
        ShortLink::create($data);

        //Возвращение готовой короткой ссылки
        $url = url()->current();
        $url = $url.'/'.$data['code'];

        return view('form')->with('url', $url);

    }

    public function redirect($code) {

        //Получение ссылки по токену и редирект на исходную ссылку

        $url = ShortLink::where('code', $code)->first();
        return redirect($url->link);

    }

    public function generateCode($lenght) {

        //Генерация рандомного токена и проверка на уникальность в таблице

        $data['code'] = Str::random($lenght);
        $validator = Validator($data, [
            'code' => 'unique:shortlinks,code'
        ]);

        if ($validator->fails()) {
            return $this->generateCode($lenght);
        }
        else {
            return $data['code'];
        }

    }

}
