<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Book;
use App\Models\BookMark;


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
            'phone' => 'required|max:11|min:11',
        ], [
                'surname.required' => 'Поле "Фамилия" обязательно для заполнения.',
                'name.required' => 'Поле "Имя" обязательно для заполнения.',
                'patronymic.required' => 'Поле "Отчество" обязательно для заполнения.',
                'login.required' => 'Поле "Логин" обязательно для заполнения.',
                'password.required' => 'Поле "Пароль" обязательно для заполнения.',
                'password.min' => 'Пароль должен содержать минимум 6 символов.',
                'password_repeat.required' => 'Поле "Повтор пароля" обязательно для заполнения.',
                'password_repeat.same' => 'Пароль и повтор пароля должны совпадать.',
                'email.required' => 'Поле "Почта" обязательно для заполнения.',
                'email.email' => 'Почта должна быть валидным адресом электронной почты.',
                'email.unique' =>    'Пользователь с такой почтой уже существует.',
                'birthday.required' => 'Поле "Дата рождения" обязательно для заполнения.',
                'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
                'phone.min' => 'Телефон должен содержать минимум 11 цифр.',
                'phone.max' => 'Телефон не должен превышать 11 цифр.',
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
        return redirect ("/account")->with("success",  "Вы успешно зарегистрировались!");
    }

    public function logIn(Request $request){
        $request->validate([
            'login' => 'required',
            'password' => 'required|min:1'
        ], [
            'login.required' => 'Поле "Логин" обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать минимум 6 символов.',
            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
        ]);
        $credentials = $request->only('login','password');
        // dd(Auth::attempt($credentials));

        if (Auth::attempt($credentials)) {
            $role_id = Auth::user()->role_id;
            switch ($role_id) {
                case 1:
                    // Редирект для пользователя с ролью 1 (Сотрудника)
                    return redirect("/admin")->with("success", "Вы успешно авторизовались!");
                case 2:
                    // Редирект для пользователя с ролью 2 (Клиента)
                    return redirect("/account")->with("success", "Вы успешно авторизовались!");
                default:
                    // Если роль не совпадает с ожидаемыми значениями
                    return redirect()->back()->with('error', 'Неправильная роль пользователя')->withInput();
            }
        } else {
            // Если не удалось аутентифицироваться, вывести ошибку
            return redirect()->back()->with('error', 'Неправильный логин или пароль')->withInput();
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
            'phone' => 'required|max:11|min:11',
        ], [
            'surname.required' => 'Поле "Фамилия" обязательно для заполнения.',
            'surname.max' => 'Поле "Фамилия" не должно превышать 100 символов.',
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'name.max' => 'Поле "Имя" не должно превышать 100 символов.',
            'patronymic.required' => 'Поле "Отчество" обязательно для заполнения.',
            'patronymic.max' => 'Поле "Отчество" не должно превышать 100 символов.',
            'login.required' => 'Поле "Логин" обязательно для заполнения.',
            'login.max' => 'Поле "Логин" не должно превышать 100 символов.',
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Поле "Email" должно быть корректным адресом электронной почты.',
            'email.unique' => 'Указанный "Email" уже занят.',
            'email.max' => 'Поле "Email" не должно превышать 150 символов.',
            'birthday.required' => 'Поле "Дата рождения" обязательно для заполнения.',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.max' => 'Поле "Телефон" не должно превышать 11 символов.',
            'phone.min' => 'Поле "Телефон" должно содержать ровно 11 символов.',
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
        return redirect()->back()->with('success','Вы успешно обновили свои данные');
    }

    public function signout(){
        Auth::logout();
        return redirect('/');
    }

    public function accountBookMarks(){
        $bookMarks = Auth::user()->book_marks;
        $bookIds = $bookMarks->pluck('book_id')->toArray();
        $books =  Book::whereIn('id', $bookIds)->paginate(9);;
        // $books = Book::paginate(9);
        return view('accountBookMarks', compact('books'));
    }
}
