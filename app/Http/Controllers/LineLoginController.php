<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LineLoginController extends Controller
{
    // LINEログイン画面へリダイレクト
    public function redirectToProvider()
    {
        return Socialite::driver('line')->redirect();
    }

    // コールバック（認証後）
    public function handleProviderCallback()
    {
        $lineUser = Socialite::driver('line')->user();

        Session::put('line_user', $lineUser);

        return redirect('/auth/line/result');
    }

    // コールバック（認証後）
    public function viewLineUser()
    {
        $lineUser = Session::get('line_user');
        if (! $lineUser) {
            // セッションが無い（リロード・直接アクセスなど）
            return redirect('/auth/line');
        }

        return view('line-user', ['lineUser' => $lineUser]);
    }
}
