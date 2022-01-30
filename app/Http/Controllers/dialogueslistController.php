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
            if (!Dialogueslist::checkUserinList($request->userid)) {
                $result = Dialogueslist::addUserinList($request->userid);
                return $result;
            } else {
                return 0;
            }
        } else {
            return abort('403');
        }
    }

    /*Добавляет пользователя в список диалогов
     * post-запрос от клиента
     */
    public function deleteuser(Request $request){
        if (Auth::id() !== null) {
            $request = json_decode($request->getContent(), true);
            $result = dialogueslist::deleteuserinlist(Auth::id(), $request['userid']);
            return $result;
        } else {
            return abort('403');
        }
    }

}
