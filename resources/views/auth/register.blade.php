@extends('layouts.app')

@section('content')
<style>
    .auth-wrapper {
        min-height: 75vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 24px;
    }
    .auth-card {
        background: #141414;
        border: 1px solid #1e1e1e;
        border-radius: 16px;
        padding: 40px;
        width: 100%;
        max-width: 420px;
    }
    .auth-logo { text-align: center; margin-bottom: 28px; }
    .auth-logo span { font-size: 32px; }
    .auth-card h1 { font-size: 22px; font-weight: 700; color: #fff; text-align: center; margin-bottom: 6px; }
    .auth-card .subtitle { font-size: 14px; color: #555; text-align: center; margin-bottom: 28px; }
    .form-group { margin-bottom: 16px; }
    .form-group label { display: block; font-size: 13px; font-weight: 500; color: #888; margin-bottom: 8px; }
    .form-group input {
        width: 100%;
        background: #0f0f0f;
        border: 1px solid #2a2a2a;
        border-radius: 8px;
        padding: 12px 14px;
        color: #e5e5e5;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        outline: none;
        transition: border-color 0.2s;
    }
    .form-group input:focus { border-color: #6366f1; }
    .form-group input.is-invalid { border-color: #f87171; }
    .invalid-feedback { color: #f87171; font-size: 12px; margin-top: 6px; display: block; }
    .btn-submit {
        width: 100%;
        background: #6366f1;
        color: #fff;
        border: none;
        padding: 13px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 8px;
        font-family: 'Inter', sans-serif;
        transition: background 0.2s;
    }
    .btn-submit:hover { background: #4f46e5; }
    .auth-footer { text-align: center; margin-top: 20px; font-size: 13px; color: #555; }
    .auth-footer a { color: #6366f1; text-decoration: none; }
    .auth-footer a:hover { text-decoration: underline; }
</style>
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-logo"><span>✨</span></div>
        <h1>Crear cuenta</h1>
        <p class="subtitle">Únete y empieza a comprar</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nombre completo</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                    class="@error('name') is-invalid @enderror" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="@error('email') is-invalid @enderror" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password"
                    class="@error('password') is-invalid @enderror" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm">Confirmar contraseña</label>
                <input id="password-confirm" type="password" name="password_confirmation"
                    required autocomplete="new-password">
            </div>
            <button type="submit" class="btn-submit">Crear cuenta</button>
        </form>
        <div class="auth-footer">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </div>
    </div>
</div>
@endsection
