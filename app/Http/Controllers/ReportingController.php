<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use App\Models\Tax;
use Yajra\DataTables\Facades\DataTables;

class ReportingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales_index()
    {
        return view('administrator.reporting.sales.index');
    }
    
    public function performance_index()
    {
        return view('administrator.reporting.performance.index');
    }
    
    public function tax_index()
    {
        return view('administrator.reporting.tax.index');
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
    public function tax_show($tax)
    {
        return view('administrator.reporting.tax.details-tax')->with([
            'tax' => $tax,
            'title' => 'Detail Taxes',
            'subtitle' => 'Detail'
        ]);
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
        //
    }

    public function dataSales()
    {
        return DataTables::of(Transaction::join('kitchens', 'transactions.kitchen_id', '=', 'kitchens.id')
                                        ->join('cashiers', 'transactions.cashier_id', '=', 'cashiers.id')
                                        ->join('customers', 'transactions.customer_id', '=', 'customers.id')
                                        ->join('detail_transactions', 'transactions.id', '=' , 'detail_transactions.transaction_id')
                                        ->select('transactions.id','kitchens.name as kitchen', 'cashiers.name as cashier','customers.name as customer', 'transactions.status','transactions.grand_total', DetailTransaction::raw('SUM(qty) as total_amount'), Transaction::raw('DATE_FORMAT(transactions.created_at, "%d/%m/%Y") as date'))
                                        ->groupBy('transactions.id')
                                        ->get())
        ->addColumn('action', function ($model) {
            return view('administrator.reporting.sales.form-action', compact('model'))->render();
        })
        ->make(true);
    }

    public function dataPerformanceCashier()
    {
        return DataTables::of(Transaction::join('cashiers', 'transactions.cashier_id', '=', 'cashiers.id')
                                        ->join('detail_transactions', 'transactions.id', '=' , 'detail_transactions.transaction_id')
                                        ->join('users', 'cashiers.user_id', '=', 'users.id')
                                        ->select('cashiers.id', 'cashiers.name as cashier', 'users.status', Transaction::raw('COUNT(*) as total_orders'), DetailTransaction::raw('SUM(qty) as products_sell'), DetailTransaction::raw('SUM(subtotal) as total_earnings'))
                                        ->where('transactions.status', 'serve')
                                        ->groupBy('cashiers.id')
                                        ->get())
        ->addColumn('action', function ($model) {
            return view('administrator.reporting.performance.cashier.form-action', compact('model'))->render();
        })
        ->make(true);
    }

    public function dataPerformanceKitchen()
    {
        return DataTables::of(Transaction::join('kitchens', 'kitchens.id', '=', 'transactions.kitchen_id')
                                        ->join('detail_transactions', 'detail_transactions.transaction_id', '=', 'transactions.id')
                                        ->join('users', 'users.id', '=', 'kitchens.user_id')
                                        ->select('kitchens.id', 'kitchens.name as kitchen', Transaction::raw('COUNT(*) as total_received'), Transaction::raw('(SELECT COUNT(*) FROM transactions WHERE transactions.status="reject" GROUP BY kitchen_id) as total_rejected'), DetailTransaction::raw('SUM(qty) as products_cooked'), 'users.status')
                                        ->where('transactions.status', 'serve')
                                        ->groupBy('kitchens.id')
                                        ->get())
        ->addColumn('action', function ($model) {
            return view('administrator.reporting.performance.kitchen.form-action', compact('model'))->render();
        })
        ->make(true);
    }

    public function dataSalesTax()
    {
        return DataTables::of(Transaction::select('tax',Transaction::raw('SUM((grand_total * tax) / 100) as totalSalesTax'))
                                        ->where('status', 'serve')
                                        ->where('tax', '>', '0')
                                        ->groupBy('tax')
                                        ->get())
        ->addColumn('action', function ($model) {
            return view('administrator.reporting.tax.form-action', compact('model'))->render();
        })
        ->make(true);
    }

    public function dataDetailTax($tax)
    {
        return DataTables::of(Transaction::select('tax', Transaction::raw('SUM((grand_total * tax) / 100) as total_income'), Transaction::raw('YEAR(created_at) as year'), Transaction::raw('MONTH(created_at) as month'))
                                        ->where('status', 'serve')
                                        ->where('tax', $tax)
                                        ->groupBy('tax', Transaction::raw('MONTH(created_at)'), Transaction::raw('YEAR(created_at)'))
                                        ->get())
        ->addColumn('month', function ($model) {
            return date('F', strtotime($model->month));
        })
        ->addColumn('year', function ($model) {
            return $model->year;
        })
        ->make(true);
    }
}
