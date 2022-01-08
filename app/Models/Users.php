<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';//имя таблицы

    //поиск людей
    public static function getUsers($name) {
        $name = '%'.$name.'%';//для оператора LIKE
        return static::select('id','name')->Where('name', 'LIKE', "$name")->get();
    }

    public static function getUser($uid) {
        return static::select('id','name')->Where('id', "$uid")->get();//$user[0]['id']
    }

}
