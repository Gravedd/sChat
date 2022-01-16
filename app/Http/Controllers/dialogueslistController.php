<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dialogueslist;

class dialogueslistController extends Controller
{
    public function index(){
        $uid = Auth::id();
        $dlist = Dialogueslist::getUserList($uid);
        return view('dialogues', compact('dlist'));
    }
}
