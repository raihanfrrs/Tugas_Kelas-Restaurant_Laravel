<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::where('status', 'archive')->get();
        $category = Category::where('status', 'archive')->get();
        $count = $product->count() + $category->count();

        return view('administrator.archive.index')->with([
            'product' => $product,
            'category' => $category,
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
            }elseif ($request->category) {
                Category::where('slug', $slug)->update(['status' => 'show']);
            }

            session(['archive' => $request->session()->get('archive')-1]);

            return redirect()->intended('/archive')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Restore Success!'
            ]);
        }

        if ($request->recycle) {
            if ($request->product) {
                Product::where('slug', $slug)->update(['status' => 'delete']);
            }elseif ($request->category) {
                Category::where('slug', $slug)->update(['status' => 'delete']);
            }

            session(['archive' => $request->session()->get('archive')-1, 'recycle' => $request->session()->get('recycle')+1]);

            return redirect()->intended('/archive')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Move to Recycle Success!'
            ]);
        }
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
