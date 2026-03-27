@extends('layouts.app')

@section('content')
<style>
    .hero {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 60px 24px;
        background: radial-gradient(ellipse at top, #1a1040 0%, #0f0f0f 60%);
    }
    .hero-badge {
        display: inline-block;
        background: #1e1b4b;
        color: #818cf8;
        border: 1px solid #312e81;
        border-radius: 20px;
        padding: 6px 16px;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 24px;
    }
    .hero h1 {
        font-size: clamp(36px, 6vw, 72px);
        font-weight: 700;
        color: #fff;
        line-height: 1.1;
        letter-spacing: -2px;
        margin-bottom: 20px;
    }
    .hero h1 span { color: #6366f1; }
    .hero p {
        font-size: 18px;
        color: #888;
        max-width: 480px;
        margin: 0 auto 36px;
        line-height: 1.6;
    }
    .hero-actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
    .btn-primary-hero {
        background: #6366f1;
        color: #fff;
        padding: 14px 32px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.2s;
        border: none;
    }
    .btn-primary-hero:hover { background: #4f46e5; color: #fff; transform: translateY(-1px); }
    .btn-secondary-hero {
        background: transparent;
        color: #ccc;
        padding: 14px 32px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        border: 1px solid #2a2a2a;
        transition: all 0.2s;
    }
    .btn-secondary-hero:hover { border-color: #444; color: #fff; }

    .features {
        padding: 80px 24px;
        max-width: 1000px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
    }
    .feature-card {
        background: #141414;
        border: 1px solid #1e1e1e;
        border-radius: 14px;
        padding: 28px;
        transition: border-color 0.2s;
    }
    .feature-card:hover { border-color: #6366f1; }
    .feature-icon { font-size: 28px; margin-bottom: 14px; }
    .feature-card h3 { font-size: 16px; font-weight: 600; color: #fff; margin-bottom: 8px; }
    .feature-card p { font-size: 14px; color: #666; line-height: 1.6; }
</style>

<div class="hero">
    <div>
        <div class="hero-badge">✦ Bienvenido a la tienda</div>
        <h1>Compra lo que<br><span>necesitas</span></h1>
        <p>Explora nuestro catálogo de productos y realiza tu pedido de forma rápida y segura.</p>
        <div class="hero-actions">
            <a href="/productos" class="btn-primary-hero">Ver productos</a>
            @guest
                <a href="{{ route('register') }}" class="btn-secondary-hero">Crear cuenta</a>
            @endguest
        </div>
    </div>
</div>

<div class="features">
    <div class="feature-card">
        <div class="feature-icon">🛍️</div>
        <h3>Amplio catálogo</h3>
        <p>Encuentra una gran variedad de productos disponibles para ti.</p>
    </div>
    <div class="feature-card">
        <div class="feature-icon">⚡</div>
        <h3>Pedidos rápidos</h3>
        <p>Agrega al carrito y finaliza tu compra en segundos.</p>
    </div>
    <div class="feature-card">
        <div class="feature-icon">🔒</div>
        <h3>Pago seguro</h3>
        <p>Tu información está protegida en todo momento.</p>
    </div>
</div>
@endsection
