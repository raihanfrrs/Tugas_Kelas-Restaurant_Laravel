<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tax;
use App\Models\TempCart;
use Illuminate\Http\Request;

class TempCartController extends Controller
{
    public function index()
    {
        return view('cashier.cart.index');
    }

    public function read()
    {
        return view('cashier.cart.data')->with([
            'cart' => TempCart::all(),
            'grand_total' => TempCart::join('products', 'temp_carts.product_id', '=', 'products.id')
                                        ->select(TempCart::raw("SUM(price * qty) as grand_total"))
                                        ->get(),
            'tax' => Tax::where('status', 'active')->get()
        ]);
    }

    public function store(Request $request, Product $product)
    {
        if (empty(TempCart::find($product->id))) {
            $cart = new TempCart();
            $cart->product_id = $product->id;
            $cart->qty = 1;
            $cart->save();

            session(['cart' => $request->session()->get('cart')+1]);

            if ($request->session()->get('product')) {
                return redirect()->intended('product/search/results')->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Product Added to Cart!',
                ]);
            }

            return redirect()->intended('menu')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Product Added to Cart!',
            ]);
        }

        if ($request->session()->get('product')) {
            return redirect()->intended('product/search/results')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Product Already in the Cart!'
            ]);
        }

        return redirect()->intended('menu')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'error',
            'message' => 'Product Already in the Cart!'
        ]);
    }

    public function update(Request $request)
    {
        TempCart::query()->where('id', $request->id)->update(['qty' => $request->qty]);
    }

    public function destroy(Request $request)
    {
        session(['cart' => $request->session()->get('cart')-1]);
        TempCart::where('product_id', $request->id)->delete();
    }
}
