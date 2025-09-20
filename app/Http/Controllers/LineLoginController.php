<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LineLoginController extends Controller
{
    // LINEログイン画面へリダイレクト
    public function redirectToProvider()
    {
        try {
            return Socialite::driver('line')->redirect();
        } catch (\Exception $e) {
            error_log('line redirectエラー: '.$e->getMessage());
        }
    }

    // コールバック（認証後）
    public function handleProviderCallback()
    {
        try {
            $lineUser = Socialite::driver('line')->user();
            Session::put('line_user', [
                'id' => $lineUser->getId(),
                'name' => $lineUser->getName(),
                'avatar' => $lineUser->getAvatar(),
                'token' => $lineUser->token,
                'expiresIn' => $lineUser->expiresIn,
            ]);

            return redirect('/auth/line/result');
        } catch (\Exception $e) {
            error_log('callbackエラー: '.$e->getMessage());
        }
    }

    public function viewLineUser()
    {
        try {
            $lineUser = Session::get('line_user');
            if (! $lineUser) {
                return redirect('/auth/line');
            }

            return view('line-user', ['lineUser' => $lineUser]);
        } catch (\Exception $e) {
            error_log('viewエラー: '.$e->getMessage());
        }
    }
}
