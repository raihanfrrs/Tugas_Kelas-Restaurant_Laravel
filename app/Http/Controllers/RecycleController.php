<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Kitchen;
use App\Models\Product;
use App\Models\User;
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
    public function update(Request $request, $slug)
    {
        if ($request->restore) {
            if ($request->product) {
                Product::where('slug', $slug)->update(['status' => 'show']);
            }else if ($request->category) {
                Category::where('slug', $slug)->update(['status' => 'show']);
            }else if ($request->cashier) {
                $cashier = Cashier::where('slug', $slug)->get();
                User::where('id', $cashier[0]->user_id)->update(['status' => 'active']);
            }else if ($request->kitchen) {
                $kitchen = Kitchen::where('slug', $slug)->get();
                User::where('id', $kitchen[0]->user_id)->update(['status' => 'active']);
            }else if ($request->customer) {
                Customer::where('slug', $slug)->update(['status' => 'show']);
            }

            session(['recycle' => $request->session()->get('recycle')-1]);

            return redirect()->intended('/recycle')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Restore Success!'
            ]);
        }

        if ($request->archive) {
            if ($request->product) {
                Product::where('slug', $slug)->update(['status' => 'archive']);
            }else if ($request->category) {
                Category::where('slug', $slug)->update(['status' => 'archive']);
            }

            session(['archive' => $request->session()->get('archive')+1, 'recycle' => $request->session()->get('recycle')-1]);

            return redirect()->intended('/recycle')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Archive Success!'
            ]);
        }

        return redirect()->intended('/recycle')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'error',
            'message' => 'Process Failed!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {
        if ($request->product) {
            Product::where('slug', $slug)->delete();
        }elseif ($request->category) {
            Category::where('slug', $slug)->delete();
        }elseif ($request->customer) {
            Customer::where('slug', $slug)->delete();
        }elseif ($request->cashier) {
            Cashier::where('slug', $slug)->delete();
        }elseif ($request->kitchen) {
            Kitchen::where('slug', $slug)->delete();
        }

        session(['recycle' => $request->session()->get('recycle')-1]);

        return redirect()->intended('/recycle')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Delete Success!'
        ]);
    }
}
