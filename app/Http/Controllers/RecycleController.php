<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Kitchen;
use App\Models\Product;
use Illuminate\Http\Request;

class RecycleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::where('status', 'delete')->get();
        $category = Category::where('status', 'delete')->get();
        $customer = Customer::where('status', 'delete')->get();
        $cashier = Cashier::join('users', 'cashiers.user_id', '=', 'users.id')->select('cashiers.*')->where('status', 'non-active')->get();
        $kitchen = Kitchen::join('users', 'kitchens.user_id', '=', 'users.id')->select('kitchens.*')->where('status', 'non-active')->get();
        $count = $product->count() + $category->count() + $customer->count() + $cashier->count() + $kitchen->count();

        return view('administrator.recycle.index')->with([
           'product' => $product,
           'category' => $category,
           'customer' => $customer,
           'cashier' => $cashier,
           'kitchen' => $kitchen,
           'count' => $count
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
