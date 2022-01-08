<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function search() {
        if (isset($_GET['username'])) {
            $name = $_GET['username'];
            $users = Users::getUsers($name);
        } else {
            $name = '';
            $users = Users::getUsers($name);
        }
        return view('search', compact('users'));
    }
    public function profile($userid) {
        $user = Users::getUser($userid);
        return view('user', compact('user'));
    }
}
