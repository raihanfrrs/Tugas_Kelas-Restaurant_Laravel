<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Kitchen;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\TempCart;
use App\Models\Transaction;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::where('status', 'delete')->get()->count();
        $category = Category::where('status', 'delete')->get()->count();
        $customer = Customer::where('status', 'delete')->get()->count();
        $cashier = Cashier::join('users', 'cashiers.user_id', '=', 'users.id')->select('cashiers.*')->where('status', 'non-active')->get()->count();
        $kitchen = Kitchen::join('users', 'kitchens.user_id', '=', 'users.id')->select('kitchens.*')->where('status', 'non-active')->get()->count();

        $count = $product + $category + $customer + $cashier + $kitchen;
        
        session(['recycle' => $count]);

        $product = Product::where('status', 'archive')->get()->count();
        $category = Category::where('status', 'archive')->get()->count();

        $count = $product + $category;

        session(['archive' => $count, 'cart' => TempCart::count()]);

        return view('welcome')->with([
            'total_products' => Product::count(),
            'total_customers' => Customer::count(),
            'total_income' => Transaction::sum('grand_total'),
            'total_orders' => Transaction::count()
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
        //
    }
}
