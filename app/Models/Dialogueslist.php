<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dialogueslist extends Model
{
    use HasFactory;
    protected $table = 'userlist';//имя таблицы
    public $timestamps = false;

    //Получить список диалогов у пользователя
    public static function getUserList($uid) {
        return DB::table('userlist')
            ->join('users', 'userlist.receiver_id', '=', 'users.id')
                ->select('users.id', 'users.name')
                    ->Where('userlist.user_id', '=', $uid)->get();
    }
    public static function checkUserinList($recieverid){
        $uid = Auth::id();
        $result = Dialogueslist::Where('user_id', $uid)
                                    ->Where('receiver_id', $recieverid)->get();
        if (isset($result[0])) {
            //результат найден
            return true;
        } else {
            //результат не найден
            return false;
        }
    }
    public static function checkUserinListReciever($recieverid){
        $uid = Auth::id();
        $result = Dialogueslist::Where('user_id', $recieverid)
            ->Where('receiver_id', $uid)->get();
        if (isset($result[0])) {
            //результат найден
            return true;
        } else {
            //результат не найден
            return false;
        }
    }
    public static function addUserinList($receiverid) {
        $uid = Auth::id();
        $userinlist = new Dialogueslist;
        $userinlist->user_id = $uid;
        $userinlist->receiver_id = $receiverid;
        return $userinlist->save();
    }
    public static function addUserinListReciever($receiverid) {
        $uid = Auth::id();
        $userinlist = new Dialogueslist;
        $userinlist->user_id = $receiverid;
        $userinlist->receiver_id = $uid;
        return $userinlist->save();
    }
    public static function deleteuserinlist($uid, $receiverid){
        $deleted = Dialogueslist::where('user_id', $uid)->where('receiver_id', $receiverid)->delete();
        return $deleted;
    }

}
