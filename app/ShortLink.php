<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model {

    //Массово присваиваемые поля
    protected $fillable = ['code','link'];

    protected $table = "shortlinks";
}
