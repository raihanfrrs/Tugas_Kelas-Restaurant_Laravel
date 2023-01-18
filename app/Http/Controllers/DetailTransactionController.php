<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DetailTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kitchen.order.index');
    }

    public function read()
    {
        return view('kitchen.order.data')->with([
            'transaction' => Transaction::join('cashiers', 'transactions.cashier_id', '=', 'cashiers.id')
                                        ->join('customers', 'transactions.customer_id', '=', 'customers.id')
                                        ->join('detail_transactions', 'transactions.id', '=' , 'detail_transactions.transaction_id')
                                        ->select('transactions.id', 'transactions.kitchen_id','transactions.status','cashiers.name as cashier', 'cashiers.image as image', 'customers.name as customer', 'transactions.grand_total', DetailTransaction::raw('SUM(qty) as total_qty'), Transaction::raw('DATE_FORMAT(transactions.created_at, "%d/%m/%Y") as date'))
                                        ->whereDate('transactions.created_at', Carbon::today())
                                        ->groupBy('transactions.id')
                                        ->orderBy('transactions.id', 'desc')
                                        ->get()
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $id)
    {
        return view('kitchen.order.details')->with([
            'details' => DetailTransaction::where('transaction_id', $id->id)
                                            ->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $id)
    {
        if ($request->status === 'accept') {
            Transaction::findOrFail($id->id)->update(['status' => 'cooking', 'kitchen_id' => auth()->user()->kitchen->id]);
        } elseif ($request->status === 'reject') {
            Transaction::findOrFail($id->id)->update(['status' => 'reject', 'kitchen_id' => auth()->user()->kitchen->id]);
        } elseif ($request->status === 'serve') {
            Transaction::findOrFail($id->id)->update(['status' => 'serve', 'kitchen_id' => auth()->user()->kitchen->id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailTransaction $detailTransaction)
    {
        //
    }
}
