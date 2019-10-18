<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * ユーザー登録
     *
     * @param Request $request
     * @return array
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $token = auth()->guard()->login($user);
        return response()->json(compact('user', 'token'), 201);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'] ?? '',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.required' => "メールアドレスを入力してください",
            'email.string' => "メールアドレスを正しく入力してください",
            'email.email' => "メールアドレスを正しく入力してください",
            'email.max' => "メールアドレスは255文字以内にしてください",
            'email.unique' => "そのメールアドレスは登録できません",
            'password.required' => "パスワードを入力してください",
            'password.string' => "パスワードを正しく入力してください",
            'password.min' => "パスワードは8文字以上にしてください",
            'password.confirmed' => "パスワードが一致していません",
        ]);
    }

    /**
     * ログイン
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['errors' => ['_' => ['メールアドレスかパスワードが間違ってます']]], 401);
        }
        $user = auth()->user();
        return compact('user', 'token');
    }

    /**
     * ログアウト
     *
     * @return array
     */
    public function logout()
    {
        auth()->guard()->logout();
        return ['message' => 'ログアウトしました'];
    }

    /**
     * ログイン中のユーザー
     *
     * @return array
     */
    public function user()
    {
        $user = auth()->user() ?: null;
        return compact('user');
    }
}
