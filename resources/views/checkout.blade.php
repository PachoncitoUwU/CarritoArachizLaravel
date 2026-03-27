@extends('layouts.app')

@section('content')
<style>
    .checkout-wrapper {
        max-width: 960px;
        margin: 0 auto;
        padding: 40px 24px 60px;
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 24px;
        align-items: start;
    }
    @media (max-width: 768px) {
        .checkout-wrapper { grid-template-columns: 1fr; }
    }

    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        letter-spacing: -0.5px;
        margin-bottom: 20px;
    }

    /* RESUMEN */
    .order-summary {
        background: #141414;
        border: 1px solid #1e1e1e;
        border-radius: 14px;
        padding: 24px;
    }
    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid #1e1e1e;
        gap: 12px;
    }
    .order-item:last-child { border-bottom: none; }
    .order-item-left { flex: 1; }
    .order-item-name { font-size: 14px; font-weight: 500; color: #e5e5e5; }
    .order-item-qty {
        display: inline-block;
        background: #1e1b4b;
        color: #818cf8;
        border-radius: 20px;
        padding: 2px 8px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 4px;
    }
    .order-item-price { font-size: 15px; font-weight: 700; color: #6366f1; white-space: nowrap; }

    .order-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 0 0;
        margin-top: 8px;
        border-top: 1px solid #2a2a2a;
    }
    .order-total-label { font-size: 15px; color: #888; }
    .order-total-amount { font-size: 24px; font-weight: 700; color: #fff; }

    .empty-cart {
        text-align: center;
        padding: 50px 20px;
        color: #555;
    }
    .empty-cart span { font-size: 48px; display: block; margin-bottom: 12px; }
    .empty-cart a { color: #6366f1; text-decoration: none; font-size: 14px; }
    .empty-cart a:hover { text-decoration: underline; }

    /* FORMULARIO PAGO */
    .payment-form {
        background: #141414;
        border: 1px solid #1e1e1e;
        border-radius: 14px;
        padding: 24px;
    }
    .form-group { margin-bottom: 16px; }
    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #888;
        margin-bottom: 8px;
    }
    .form-group select,
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
        appearance: none;
    }
    .form-group select:focus,
    .form-group input:focus { border-color: #6366f1; }
    .form-group select option { background: #1a1a1a; }

    .btn-order {
        width: 100%;
        background: #6366f1;
        color: #fff;
        border: none;
        padding: 14px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 8px;
        transition: background 0.2s;
        font-family: 'Inter', sans-serif;
    }
    .btn-order:hover { background: #4f46e5; }
    .btn-order:active { transform: scale(0.99); }

    .alert {
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .alert-success { background: #052e16; border: 1px solid #166534; color: #4ade80; }
    .alert-error { background: #2d0a0a; border: 1px solid #7f1d1d; color: #f87171; }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #666;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 24px;
        transition: color 0.2s;
    }
    .back-link:hover { color: #fff; }
</style>

<div style="max-width:960px; margin:0 auto; padding: 30px 24px 0;">
    <a href="/productos" class="back-link">← Volver a la tienda</a>

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif
</div>

<div class="checkout-wrapper">
    {{-- RESUMEN DEL PEDIDO --}}
    <div class="order-summary">
        <div class="section-title">Resumen del pedido</div>
        <div id="order-items">
            <div class="empty-cart">
                <span>🛒</span>
                Tu carrito está vacío.<br>
                <a href="/productos">Ver productos</a>
            </div>
        </div>
        <div class="order-total" id="order-total" style="display:none">
            <span class="order-total-label">Total a pagar</span>
            <span class="order-total-amount" id="total-display">$0</span>
        </div>
    </div>

    {{-- FORMULARIO --}}
    <div class="payment-form">
        <div class="section-title">Método de pago</div>
        <form action="/checkout" method="POST" id="checkout-form">
            @csrf
            <div id="hidden-inputs"></div>

            <div class="form-group">
                <label>Selecciona tu método de pago</label>
                <select name="metodo_pago" required>
                    <option value="" disabled selected>Elige una opción</option>
                    <option value="efectivo">💵 Efectivo</option>
                    <option value="tarjeta">💳 Tarjeta de crédito/débito</option>
                    <option value="transferencia">🏦 Transferencia bancaria</option>
                    <option value="nequi">📱 Nequi</option>
                </select>
            </div>

            <button type="submit" class="btn-order" id="btn-order" disabled>
                Confirmar pedido
            </button>
        </form>
    </div>
</div>

<script>
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    let orderItems = document.getElementById('order-items');
    let orderTotal = document.getElementById('order-total');
    let totalDisplay = document.getElementById('total-display');
    let hiddenInputs = document.getElementById('hidden-inputs');
    let btnOrder = document.getElementById('btn-order');

    if (!carrito.length) {
        btnOrder.disabled = true;
    } else {
        let total = 0;
        orderItems.innerHTML = '';

        carrito.forEach(product => {
            let subtotal = product.cantidad * product.price;
            total += subtotal;

            orderItems.innerHTML += `
                <div class="order-item">
                    <div class="order-item-left">
                        <div class="order-item-name">${product.name}</div>
                        <span class="order-item-qty">x${product.cantidad}</span>
                    </div>
                    <span class="order-item-price">$${subtotal.toFixed(2)}</span>
                </div>`;

            hiddenInputs.innerHTML += `
                <input type="hidden" name="product_id[]" value="${product.id}">
                <input type="hidden" name="price[]" value="${product.price}">
                <input type="hidden" name="cantidad[]" value="${product.cantidad}">`;
        });

        orderTotal.style.display = 'flex';
        totalDisplay.textContent = '$' + total.toFixed(2);
        btnOrder.disabled = false;
    }

    // Limpiar carrito tras éxito
    @if(session('success'))
        localStorage.removeItem('carrito');
    @endif
</script>
@endsection
