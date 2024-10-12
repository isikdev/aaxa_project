<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сброс пароля</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Стандартные стили Tailwind CSS */
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4f46e5;
            padding: 20px;
            text-align: center;
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background-color: white;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .content h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #4b5563;
        }
        .content .password {
            font-size: 18px;
            font-weight: bold;
            color: #d97706;
            background-color: #fef3c7;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
        }
        .content .cta {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            color: #9ca3af;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ваш пароль был сброшен</h1>
        </div>
        <div class="content">
            <h1>Здравствуйте, {{ $name }}!</h1>
            <p>Ваш пароль был успешно сброшен. Мы сгенерировали для вас новый пароль, который вы можете использовать для входа в систему.</p>
            <div class="password">{{ $newPassword }}</div>
            <p>Не забудьте изменить его на более привычный вам после входа в систему для вашей безопасности.</p>
            <a href="{{ url('/') }}" class="cta">Перейти на сайт</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Все права защищены.</p>
        </div>
    </div>
</body>
</html>

