<?php

namespace App\Http\Controllers;

use App\Models\messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index() {
        $id = Auth::id();
        return $this->viewreturn($id);
    }
    public function getJson() {
        $messages = messages::getAllMessages('1', '2');
        return response()->json($messages, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
    }
    public function viewreturn($id) {
        return view('chat', compact('id'));
    }
}
