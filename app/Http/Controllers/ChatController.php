<?php

namespace App\Http\Controllers;

use App\Models\messages;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($userid) {
        $id = Auth::id();
        $sendid = $userid;
        $userinf = Users::getUser($sendid);
        return $this->viewreturn($id, $sendid, $userinf);
    }

    public function viewreturn($id, $sendid, $userinf) {
        return view('chat', compact('id', 'sendid', 'userinf'));
    }

    public function getJson(Request $request) {
        //Получение сообщения
        $fromclient = json_decode($request->getContent(), true);
        $receiverid = (int)$fromclient['sendid'];
        $id = Auth::id();
        $messages = messages::getAllMessages($id, $receiverid);
        return response()->json($messages, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }


    public function sendMessage(Request $request) {
        //Получение сообщения
        $message = json_decode($request->getContent(), true);
        //формируем переменные
        $mess = $message['message'];
        $uid = Auth::id();
        $sendid = $message['sendid'];
        //запись сообщения в БД
        $result['response'] = messages::saveMessage($mess, $uid, $sendid);
        //$result['response'] = 'server error';//использовать для текста ошибки

        return response()->json($result, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }


    public function checknew(Request $request) {
        //Получение данных
        $data = json_decode($request->getContent(), true);
        $lastid = $data['lastid'];
        $sendid = $data['sendid'];
        $uid = Auth::id();
        while(true) {
            $messages = messages::getNewMessages($uid, $sendid, $lastid);
            if (isset($messages[0])) {
                return response()->json($messages, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
            }
            sleep(1);
        }
    }
}
