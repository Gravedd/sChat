<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    use HasFactory;
    protected $table = 'messages';//имя таблицы

    public static function getAllMessages($uid, $receiverid) {
        return static::WhereRaw("(`user_id` = $uid AND `receiver_id` = $receiverid) OR (`user_id` = $receiverid AND `receiver_id` = $uid)")->get();
    }
    public static function getCountAllMessages($uid, $receiverid) {
        return static::WhereRaw("(`user_id` = $uid AND `receiver_id` = $receiverid) OR (`user_id` = $receiverid AND `receiver_id` = $uid)")->count();
    }
    public static function getNewMessages($uid, $receiverid, $lastid) {
        return static::WhereRaw("((`user_id` = $uid AND `receiver_id` = $receiverid AND `id`>$lastid) OR (`user_id` = $receiverid AND `receiver_id` = $uid AND `id`>$lastid))")->get();
    }

    public static function saveMessage($mess, $uid, $receiverid) {
        $message = new messages;
        $message->user_id = $uid;
        $message->receiver_id = $receiverid;
        $message->message = $mess;
        $result = $message->save();
        return $result;
    }
}
