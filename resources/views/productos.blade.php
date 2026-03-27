@extends('layouts.app')

@section('content')
<style>
    .page-header {
        padding: 40px 24px 20px;
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    .page-header h1 { font-size: 28px; font-weight: 700; color: #fff; letter-spacing: -0.5px; }
    .page-header p { font-size: 14px; color: #666; margin-top: 4px; }

    .cart-badge {
        background: #1a1a1a;
        border: 1px solid #2a2a2a;
        border-radius: 10px;
        padding: 10px 18px;
        font-size: 14px;
        color: #ccc;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .cart-badge:hover { border-color: #6366f1; color: #fff; }
    .cart-count {
        background: #6366f1;
        color: #fff;
        border-radius: 20px;
        padding: 2px 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .layout {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px 60px;
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 24px;
        align-items: start;
    }
    @media (max-width: 900px) {
        .layout { grid-template-columns: 1fr; }
        .sidebar { order: -1; }
    }

    /* GRID PRODUCTOS */
    .productos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
    }
    .card-producto {
        background: #141414;
        border: 1px solid #1e1e1e;
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.2s;
        cursor: pointer;
    }
    .card-producto:hover { border-color: #6366f1; transform: translateY(-2px); }
    .img-container { width: 100%; height: 180px; background: #1a1a1a; overflow: hidden; }
    .img-container img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
    .card-producto:hover .img-container img { transform: scale(1.04); }
    .card-info { padding: 14px; }
    .card-info h3 { font-size: 14px; font-weight: 600; color: #e5e5e5; margin-bottom: 6px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .card-info .precio { font-size: 18px; font-weight: 700; color: #6366f1; margin-bottom: 12px; }
    .card-info .stock { font-size: 12px; color: #555; margin-bottom: 12px; }
    .btn-add {
        width: 100%;
        background: #6366f1;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-add:hover { background: #4f46e5; }
    .btn-add:active { transform: scale(0.98); }

    .empty-state { text-align: center; padding: 80px 20px; color: #555; }
    .empty-state span { font-size: 48px; display: block; margin-bottom: 12px; }

    /* SIDEBAR CARRITO */
    .sidebar {
        background: #141414;
        border: 1px solid #1e1e1e;
        border-radius: 14px;
        padding: 20px;
        position: sticky;
        top: 20px;
    }
    .sidebar-title {
        font-size: 16px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .sidebar-title span { color: #555; font-size: 13px; font-weight: 400; }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #1e1e1e;
        gap: 8px;
    }
    .cart-item-name { font-size: 13px; color: #ccc; flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .cart-item-price { font-size: 13px; color: #6366f1; font-weight: 600; white-space: nowrap; }
    .cart-controls { display: flex; align-items: center; gap: 6px; }
    .ctrl-btn {
        width: 26px; height: 26px;
        background: #1e1e1e;
        border: 1px solid #2a2a2a;
        color: #ccc;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.15s;
    }
    .ctrl-btn:hover { background: #2a2a2a; color: #fff; }
    .ctrl-btn.del { border-color: #3a1a1a; color: #f87171; }
    .ctrl-btn.del:hover { background: #3a1a1a; }
    .qty { font-size: 13px; color: #fff; min-width: 16px; text-align: center; }

    .cart-empty { text-align: center; padding: 30px 0; color: #444; font-size: 14px; }
    .cart-empty span { font-size: 32px; display: block; margin-bottom: 8px; }

    .cart-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0 0;
        margin-top: 4px;
    }
    .cart-total-label { font-size: 14px; color: #888; }
    .cart-total-amount { font-size: 20px; font-weight: 700; color: #fff; }

    .btn-checkout {
        display: block;
        width: 100%;
        background: #6366f1;
        color: #fff;
        text-align: center;
        padding: 13px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        margin-top: 14px;
        transition: background 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-checkout:hover { background: #4f46e5; color: #fff; }
    .btn-checkout:disabled { background: #2a2a2a; color: #555; cursor: not-allowed; }
</style>

<div class="page-header">
    <div>
        <h1>Tienda</h1>
        <p>{{ $products->count() }} productos disponibles</p>
    </div>
</div>

<div class="layout">
    {{-- PRODUCTOS --}}
    <div>
        @if($products->isEmpty())
            <div class="empty-state">
                <span>📦</span>
                No hay productos disponibles.
            </div>
        @else
            <div class="productos-grid">
                @foreach ($products as $product)
                    <div class="card-producto">
                        <div class="img-container">
                            <img src="images/FotoProduct.png" alt="{{ $product->name }}">
                        </div>
                        <div class="card-info">
                            <h3 title="{{ $product->name }}">{{ $product->name }}</h3>
                            <div class="precio">${{ number_format($product->price, 2) }}</div>
                            <div class="stock">Stock: {{ $product->stock }}</div>
                            <button class="btn-add" onclick='agregarAlCarrito(@json($product))'>
                                + Añadir al carrito
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- SIDEBAR CARRITO --}}
    <div class="sidebar">
        <div class="sidebar-title">
            🛒 Carrito
            <span id="cart-count-label">0 items</span>
        </div>
        <div id="carrito-items"></div>
        <div class="cart-total" id="cart-total" style="display:none">
            <span class="cart-total-label">Total</span>
            <span class="cart-total-amount" id="total-amount">$0</span>
        </div>
        <a href="/checkout" class="btn-checkout" id="btn-checkout">Ir al checkout →</a>
    </div>
</div>

<script>
let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
renderCarrito();

function agregarAlCarrito(product) {
    let idx = carrito.findIndex(i => Number(i.id) === Number(product.id));
    if (idx === -1) { product.cantidad = 1; carrito.push(product); }
    else carrito[idx].cantidad++;
    guardar();
}

function sumar(id) {
    let item = carrito.find(p => Number(p.id) === Number(id));
    if (item) { item.cantidad++; guardar(); }
}

function restar(id) {
    let idx = carrito.findIndex(p => Number(p.id) === Number(id));
    if (idx !== -1) {
        carrito[idx].cantidad--;
        if (carrito[idx].cantidad <= 0) carrito.splice(idx, 1);
        guardar();
    }
}

function eliminar(id) {
    carrito = carrito.filter(p => Number(p.id) !== Number(id));
    guardar();
}

function guardar() {
    localStorage.setItem('carrito', JSON.stringify(carrito));
    renderCarrito();
}

function renderCarrito() {
    let div = document.getElementById('carrito-items');
    let totalSection = document.getElementById('cart-total');
    let totalEl = document.getElementById('total-amount');
    let countLabel = document.getElementById('cart-count-label');
    let btnCheckout = document.getElementById('btn-checkout');

    if (!carrito.length) {
        div.innerHTML = '<div class="cart-empty"><span>🛒</span>Tu carrito está vacío</div>';
        totalSection.style.display = 'none';
        btnCheckout.style.opacity = '0.4';
        btnCheckout.style.pointerEvents = 'none';
        countLabel.textContent = '0 items';
        return;
    }

    let total = 0;
    let totalItems = 0;
    div.innerHTML = '';

    carrito.forEach(item => {
        let subtotal = item.price * item.cantidad;
        total += subtotal;
        totalItems += item.cantidad;
        div.innerHTML += `
        <div class="cart-item">
            <span class="cart-item-name" title="${item.name}">${item.name}</span>
            <div class="cart-controls">
                <button class="ctrl-btn" onclick="restar(${item.id})">−</button>
                <span class="qty">${item.cantidad}</span>
                <button class="ctrl-btn" onclick="sumar(${item.id})">+</button>
                <button class="ctrl-btn del" onclick="eliminar(${item.id})">✕</button>
            </div>
            <span class="cart-item-price">$${subtotal.toFixed(2)}</span>
        </div>`;
    });

    totalSection.style.display = 'flex';
    totalEl.textContent = '$' + total.toFixed(2);
    countLabel.textContent = totalItems + ' item' + (totalItems !== 1 ? 's' : '');
    btnCheckout.style.opacity = '1';
    btnCheckout.style.pointerEvents = 'auto';
}
</script>
@endsection
