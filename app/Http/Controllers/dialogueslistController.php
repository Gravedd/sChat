<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dialogueslist;

class dialogueslistController extends Controller
{
    /*Вывод списка диалогов у пользователя
     *
     */
    public function index(){
        if (Auth::id() !== null) {
            $uid = Auth::id();
            $dlist = Dialogueslist::getUserList($uid);
            return view('dialogues', compact('dlist'));
        } else {
            return redirect('/login');
        }

    }
    /*Добавляет пользователя в список диалогов
     * post-запрос от клиента
     */
    public function addUser(Request $request){
        if (Auth::id() !== null) {
            $result = Dialogueslist::addUserinList($request->userid);
            return $result;
        } else {
            return abort('403');
        }
    }
}
