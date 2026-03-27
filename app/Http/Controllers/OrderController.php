<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    function store(Request $request)
    {
        $product_ids = $request->input('product_id', []);
        $prices      = $request->input('price', []);
        $cantidades  = $request->input('cantidad', []);

   
        if (empty($product_ids)) {
            return redirect('/checkout')->with('error', '¡El carrito está vacío!');
        }

        $orden = new Order();
        $orden->user_id     = 1;
        $orden->metodo_pago = 'tarjeta';
        $orden->save();

        foreach ($product_ids as $index => $producto_id) {
            $orden->products()->attach($producto_id, [
                'price'    => $prices[$index],
                'cantidad' => $cantidades[$index],
            ]);
        }

        return redirect('/checkout')->with('success', '¡Pedido #' . $orden->id . ' realizado exitosamente!');
    }
}