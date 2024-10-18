<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Метод сброса пароля.
     *
     * @param \App\Models\User $user
     * @param string $password
     * @return void
     */
    protected function resetPassword(User $user, $password)
    {
        // Генерируем новый случайный пароль
        $newPassword = Str::random(12);  // Генерируем пароль длиной 12 символов

        // Обновляем пароль в базе данных
        $user->password = Hash::make($newPassword);
        $user->setRememberToken(Str::random(60));
        $user->save();

        // Отправляем новый пароль на email пользователя
        $this->sendNewPasswordEmail($user, $newPassword);

        // Логиним пользователя после изменения пароля
        $this->guard()->login($user);
    }

    /**
     * Отправка письма с новым паролем.
     *
     * @param \App\Models\User $user
     * @param string $newPassword
     * @return void
     */
    protected function sendNewPasswordEmail(User $user, $newPassword)
        {
            $emailData = [
                'name' => $user->name,
                'email' => $user->email,
                'newPassword' => $newPassword,
            ];

            // Отправляем email с использованием Mail::send()
            Mail::send('emails.password-reset', $emailData, function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Ваш пароль был сброшен');
            });
        }
}
