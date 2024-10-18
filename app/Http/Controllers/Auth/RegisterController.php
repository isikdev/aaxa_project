<?php

namespace App\Http\Controllers\Auth;

use App\Models\User; // Исправляем путь к модели
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Http; // Подключаем HTTP-клиент для работы с Telegram

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'], // Проверка уникальности имени
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8', // Минимум 8 символов
                'regex:/[A-Z]/', // Обязательная заглавная буква
                'regex:/[!@#$%^&*]/', // Обязательный спецсимвол
                'confirmed',
            ],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Отправка уведомления в Telegram
        $this->sendTelegramNotification($user);

        return $user;
    }

protected function sendTelegramNotification($user)
{
    // Используем правильный API токен и chat_id
    $apiToken = '7207029273:AAEhbW4uLzSTLBhw06YsXbNCDpit4019GpU';  
    $chatId = '-1002314315563';  // Убедись, что chat_id правильный
    $message = "Новый пользователь зарегистрировался: " . $user->email;

    // Используем HTTP-клиент Laravel для отправки сообщения
    Http::post("https://api.telegram.org/bot{$apiToken}/sendMessage", [
        'chat_id' => $chatId,
        'text' => $message,
    ]);
}
}
