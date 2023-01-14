<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Customer;
use App\Models\DetailTransaction;
use App\Models\Tax;
use App\Models\TempCart;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cashier.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->customer_name;
        $customer->save();

        $grand_total    = TempCart::join('products', 'temp_carts.product_id', '=', 'products.id')
                                    ->select(TempCart::raw("SUM(price * qty) as grand_total"))
                                    ->get();
        $cashier        = Cashier::where('user_id', auth()->user()->id)->get();
        $tax            = Tax::where('status', 'active')->get();

        $transaction = new Transaction();
        $transaction->cashier_id = $cashier[0]->id;
        $transaction->customer_id = $customer->id;
        if ($tax->count() > 0) {
            $transaction->tax = $tax[0]->tax;
        }else {
            $transaction->tax = 0;
        }
        $transaction->grand_total = $grand_total[0]->grand_total + ($grand_total[0]->grand_total * $transaction->tax / 100);
        $transaction->save();

        $array = TempCart::all();
        foreach ($array as $key => $value) {
            $d_transaction = new DetailTransaction();
            $d_transaction->transaction_id = $transaction->id;
            $d_transaction->product_id = $value->product_id;
            $d_transaction->qty = $value->qty;
            $d_transaction->subtotal = $value->qty * $value->product->price;
            $d_transaction->save();

            TempCart::whereId($value->id)->delete();
        }

        $request->session()->forget(['cart']);

        return $transaction->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
