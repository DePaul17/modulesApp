<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function showForgetPasswordForm(){
        return view('auth.ui-forgetPassword');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function submitForgetPasswordForm(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? Redirect::back()->with(['message' => 'Nous vous avons envoyé un e-mail!', 'status' => __($status)])
            : Redirect::back()->withErrors(['email' => __($status)]);
    }

    /**

     * Write code on Method
     *
     * @return response()
     */

    public function showResetPasswordForm($token){
        return view('auth.ui-forgetPasswordLink', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function submitResetPasswordForm(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ], [
            'password.confirmed' => 'Le mot de passe et la confirmation ne correspondent pas.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}