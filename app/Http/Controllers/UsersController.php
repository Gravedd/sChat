<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /*Фукнция поиска людей в системе
     *По-умолчанию показывает всех пользователей
     * Если есть get-запрос то ищет пользователя с таким именем
     */
    public function search() {
        if (Auth::id() !== null) {
            if (isset($_GET['username'])) {
                $name = $_GET['username'];
                $users = Users::getUsers($name);
            } else {
                $name = '';
                $users = Users::getUsers($name);
            }
            return view('search', compact('users'));
        } else {
            return redirect('/login');
        }
    }
    /*Выводит информацию о пользователе
     *
     */
    public function profile($userid) {
        if (Auth::id() !== null) {
            $user = Users::getUser($userid);
            return view('user', compact('user'));
        } else {
            return redirect('/login');
        }
    }
}
