@extends('layouts.app')

@section('content')
<style>
    .dashboard-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 24px 60px;
    }
    .welcome-card {
        background: linear-gradient(135deg, #1e1b4b 0%, #141414 100%);
        border: 1px solid #312e81;
        border-radius: 16px;
        padding: 36px;
        margin-bottom: 24px;
    }
    .welcome-card h2 { font-size: 24px; font-weight: 700; color: #fff; margin-bottom: 8px; }
    .welcome-card p { font-size: 15px; color: #818cf8; }

    .alert-success {
        background: #052e16;
        border: 1px solid #166534;
        color: #4ade80;
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }
    .action-card {
        background: #141414;
        border: 1px solid #1e1e1e;
        border-radius: 14px;
        padding: 24px;
        text-decoration: none;
        transition: all 0.2s;
        display: block;
    }
    .action-card:hover { border-color: #6366f1; transform: translateY(-2px); }
    .action-card .icon { font-size: 28px; margin-bottom: 12px; }
    .action-card h3 { font-size: 15px; font-weight: 600; color: #fff; margin-bottom: 6px; }
    .action-card p { font-size: 13px; color: #555; }
</style>

<div class="dashboard-wrapper">
    @if (session('status'))
        <div class="alert-success">{{ session('status') }}</div>
    @endif

    <div class="welcome-card">
        <h2>Hola, {{ Auth::user()->name }} 👋</h2>
        <p>Bienvenido de vuelta. ¿Qué quieres hacer hoy?</p>
    </div>

    <div class="quick-actions">
        <a href="/productos" class="action-card">
            <div class="icon">🛍️</div>
            <h3>Ver productos</h3>
            <p>Explora el catálogo completo</p>
        </a>
        <a href="/checkout" class="action-card">
            <div class="icon">🛒</div>
            <h3>Mi carrito</h3>
            <p>Revisa y finaliza tu pedido</p>
        </a>
    </div>
</div>
@endsection
