<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    use HasFactory;
    protected $table = 'messages';//имя таблицы

    public static function getAllMessages($uid, $reveiverid) {
        return static::WhereRaw("(`user_id` = $uid AND `receiver_id` = $reveiverid) OR (`user_id` = $reveiverid AND `receiver_id` = $uid)")->get();
    }
}
