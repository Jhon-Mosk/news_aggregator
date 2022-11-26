<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $errors = [];
        $user = Auth::user();


        if ($request->isMethod('post')) {
            $this->validate($request, $this->validateRules(), [], $this->attributeNames());

            if (Hash::check($request->password, $user->password)) {
                $user->fill([
                    'name' => $request->name,
                    'password' => Hash::make($request->password_new),
                    'email' => $request->email,
                ])->save();

                return redirect()->route('profile')->withSuccess('Профиль успешно изменён');
            } else {
                $errors['password'][] = 'Не верно введён текущий пароль';
                return redirect()->route('profile')->withErrors($errors);
            }
        }

        return view('profile', [
            'user' => $user
        ]);
    }

    protected function validateRules()
    {
        return [
            'name' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'required',
            'password_new' => 'required|string|min:3',
        ];
    }

    protected function attributeNames()
    {
        return [
            'password_new' => 'Новый пароль'
        ];
    }
}
