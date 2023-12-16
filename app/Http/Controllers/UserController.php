<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Book;


class UserController extends Controller
{
    public function signUp(Request $request){
        $request->validate([
            'surname' => 'required|max:100',
            'name' => 'required|max:100',
            'patronymic' => 'required|max:100',
            'login' => 'required|max:100',
            'password' => 'required|max:100|min:6',
            'password_repeat' => 'required|same:password',
            'email' => 'required|email|unique:users|max:150',
            'birthday' => 'required',
            'phone' => 'required|max:12|min:12',
        ]);
        // dd($request);
        $user = $request->all();
        
        $login = User::create([
            'surname' => $user['surname'],
            'name' => $user['name'],
            'patronymic' => $user['patronymic'],
            'login' => $user['login'],
            'password' => Hash::make($user['password']),
            'email' => $user['email'],
            'birthday' => $user['birthday'],
            'phone' => $user['phone'],
            "role_id"=>"2"
        ]);
        Auth::login($login);
        return redirect ("/accountUser")->with("success",  "");
    }

    public function logIn(Request $request){
        $request->validate([
            'login' => 'required',
            'password' => 'required|min:1'
        ]);
        $credentials = $request->only('login','password');
        // dd($credentials);

        if (Auth::attempt($credentials)) {
            $role_id = Auth::user()->role_id;
    
            switch ($role_id) {
                case 1:
                    // Редирект для пользователя с ролью 1 (например, администратора)
                    return redirect("/")->with("success", "");
                case 2:
                    // Редирект для пользователя с ролью 2 (например, обычного пользователя)
                    return redirect("/account")->with("success", "");
            }
        }
    }

    public function account(){
        $user = Auth::user();
        return view('account', compact('user'));
    }

    public function accountUserUpdate(Request $request){
        $request->validate([
            'surname' => 'required|max:100',
            'name' => 'required|max:100',
            'patronymic' => 'required|max:100',
            'login' => 'required|max:100',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id.'|max:150',
            'birthday' => 'required',
            'phone' => 'required|max:12|min:12',
        ]);
        // Получаем авторизованного пользователя
        $user = Auth::user();   

        // dd($user);
        // Обновление
        if($user->surname != $request['surname']) $user->surname = $request['surname'];
        if($user->name != $request['name']) $user->name = $request['name'];
        if($user->patronymic != $request['patronymic']) $user->patronymic = $request['patronymic'];
        if($user->login != $request['login']) $user->login = $request['login'];
        if($user->email != $request['email']) $user->email = $request['email'];
        if($user->birthday != $request['birthday']) $user->birthday = $request['birthday'];
        if($user->phone != $request['phone']) $user->phone = $request['phone'];
        
        $user->save();
        return redirect('/accountUser');
    }

    public function signout(){
        Auth::logout();
        return redirect('/');
    }

    public function accountBookMarks(){
        $books = Book::paginate(9);
        return view('accountBookMarks', compact('books'));
    }
}
