@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                <!-- Ошибка имени в реальном времени -->
                                <span id="name-error" class="text-danger small"></span>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                <!-- Ошибка email в реальном времени -->
                                <span id="email-error" class="text-danger small"></span>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <button class="btn btn-outline-secondary" type="button" id="toggle-password">👁️</button>
                                </div>

                                <!-- Ошибка пароля -->
                                <span id="password-error" class="text-danger small"></span>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Confirmation -->
                        <div class="form-group row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Скрипты для проверки в реальном времени и показа пароля -->
<script>
    // Проверка уникальности имени
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        fetch('/check-name?name=' + name)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    document.getElementById('name-error').innerText = 'Это имя уже занято, выберите другое.';
                } else {
                    document.getElementById('name-error').innerText = '';
                }
            });
    });

    // Проверка уникальности email
    document.getElementById('email').addEventListener('input', function() {
        const email = this.value;
        fetch('/check-email?email=' + email)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    document.getElementById('email-error').innerText = 'Этот email уже зарегистрирован.';
                } else {
                    document.getElementById('email-error').innerText = '';
                }
            });
    });

    // Валидация пароля
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const regex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[a-zA-Z]).{8,}$/;
        if (!regex.test(password)) {
            document.getElementById('password-error').innerText = 'Пароль должен содержать минимум 8 символов, одну заглавную букву и один спецсимвол.';
        } else {
            document.getElementById('password-error').innerText = '';
        }
    });

    // Кнопка показа/скрытия пароля
    const togglePassword = document.querySelector('#toggle-password');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
    });
</script>
@endsection
