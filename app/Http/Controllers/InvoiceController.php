<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cashier.invoice.index');
    }

    public function read(Transaction $transaction)
    {
        return view('cashier.invoice.invoice')->with([
            'head' => Transaction::where('id', $transaction->id)->with('cashier')->get(),
            'body' => DetailTransaction::where('transaction_id', $transaction->id)->with('product')->get(),
            'subtotal' => DetailTransaction::join('products', 'detail_transactions.product_id', '=', 'products.id')
                                            ->select(DetailTransaction::raw("SUM(price * qty) as grand_total"))
                                            ->where('transaction_id', $transaction->id)
                                            ->get()
        ]);
    }

    public function download(Transaction $transaction)
    {
        $subtotal = DetailTransaction::join('products', 'detail_transactions.product_id', '=', 'products.id')
                                    ->select(DetailTransaction::raw("SUM(price * qty) as grand_total, SUM(qty) as total_qty"))
                                    ->where('transaction_id', $transaction->id)
                                    ->get();

        $fileName = $transaction->id."/".date('dmY', strtotime($transaction->created_at))."/".$subtotal[0]->total_qty;
        $pdf = PDF::loadview('cashier.invoice.template-invoice', [
            'head' => Transaction::where('id', $transaction->id)->with('cashier')->get(),
            'body' => DetailTransaction::where('transaction_id', $transaction->id)->with('product')->get(),
            'subtotal' => $subtotal,
            'fileName' => $fileName
        ]);

        return $pdf->download($fileName.".pdf");
    }

    public function print(Transaction $transaction)
    {
        return view('cashier.invoice.print-receipt')->with([
            'head' => Transaction::where('id', $transaction->id)->with('cashier')->get(),
            'body' => DetailTransaction::where('transaction_id', $transaction->id)->with('product')->get(),
            'subtotal' => DetailTransaction::join('products', 'detail_transactions.product_id', '=', 'products.id')
                                            ->select(DetailTransaction::raw("SUM(price * qty) as grand_total"))
                                            ->where('transaction_id', $transaction->id)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function dataInvoice(){
        return DataTables::of(Transaction::join('kitchens', 'transactions.kitchen_id', '=', 'kitchens.id')
                                        ->join('customers', 'transactions.customer_id', '=', 'customers.id')
                                        ->join('detail_transactions', 'transactions.id', '=' , 'detail_transactions.transaction_id')
                                        ->select('transactions.id','kitchens.name as kitchen', 'customers.name as customer', 'transactions.status','transactions.grand_total', DetailTransaction::raw('SUM(qty) as total_amount'), Transaction::raw('DATE_FORMAT(transactions.created_at, "%d/%m/%Y") as date'))
                                        ->where('transactions.cashier_id', auth()->user()->cashier->id)
                                        ->groupBy('transactions.id')
                                        ->get())
        ->addColumn('status', function ($model) {
            return view('cashier.invoice.status-action', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('cashier.invoice.form-action', compact('model'))->render();
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }
}
