<?php

namespace App\Http\Controllers;

use App\Models\messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($userid) {
        $id = Auth::id();
        $sendid = $userid;
        return $this->viewreturn($id, $sendid);
    }
    public function viewreturn($id, $sendid) {
        return view('chat', compact('id', 'sendid'));
    }
    public function getJson() {
        $messages = messages::getAllMessages('1', '2');
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
}
