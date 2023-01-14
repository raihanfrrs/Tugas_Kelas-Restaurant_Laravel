<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Enums\ServerStatus;
use Illuminate\Http\Request;

use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $array = array();
        $bigArray = array();
        $category = Product::join('categories', 'products.category_id', '=', 'categories.id')
                                ->select('products.*', 'categories.*')
                                ->orderBy('categories.id')
                                ->get();
        foreach ($category as $key => $value) {
            array_push($array, $value->id);
        }

        $counter = array_values(array_unique($array));

        for ($i=0; $i < count($counter); $i++) { 
            $product = Product::join('categories', 'products.category_id', '=', 'categories.id')
                                ->select('products.*')
                                ->where('products.category_id', '=', $counter[$i])
                                ->get(); 
            array_push($bigArray, $product);
        }

        if (auth()->user()->level == 'administrator') {
            return view('administrator.master.product.index');
        }elseif (auth()->user()->level == 'cashier') {
            if (!empty($request->session()->get('product'))) {
                $request->session()->forget(['input', 'product']);
            }

            return view('cashier.product.index')->with([
                'product' => $bigArray
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.master.product.add-product')->with([
            'category' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required|min:2|max:255|unique:products',
            'price' => 'required|numeric',
            'description' => 'max:2500',
            'image' => 'image|file|max:2048',
            'category_id' => 'required',
            'status' => [new Enum(ServerStatus::class)]
        ]);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('product-image');
        }

        $validateData['status'] = 'show';

        Product::create($validateData);

        return redirect()->intended('/product/create')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Add Product Success!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('administrator.master.product.detail-product')->with([
            'product' => $product,
            'subtitle' => $product->product_name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product)
    {
        return view('administrator.master.product.edit-product')->with([
            'product' => $product,
            'category' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'price' => 'required|numeric',
            'description' => '',
            'category_id' => 'required',
            'image' => 'image|file|max:2048',
            'status' => 'required'
        ];

        if($request->product_name != $product->product_name){
            $rules['product_name'] = 'required|min:2|max:255|unique:products';
        }

        if ($request->status == 'archive') {
            session(['archive' => $request->session()->get('archive')+1]);
        }

        if ($request->status == 'delete') {
            session(['recycle' => $request->session()->get('recycle')+1]);
        }

        $validateData = $request->validate($rules);

        if ($request->file('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $validateData['image'] = $request->file('image')->store('product-image');
        }

        Product::where('slug', $product->slug)->update($validateData);

        return redirect()->intended('/product')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Update Success!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        Product::where('slug', $product->slug)->update(['status' => 'delete']);

        session(['recycle' => $request->session()->get('recycle')+1]);

        return redirect()->intended('/product')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Delete Success!'
        ]);
    }

    public function dataProduct(){
        return DataTables::of(Product::query()->where('status', 'show'))
        ->addColumn('action', function ($model) {
            return view('administrator.master.product.form-action', compact('model'))->render();
        })
        ->make(true);
    }

    public function search(Request $request){
        $search = Product::join('categories', 'products.category_id', '=', 'categories.id')
                        ->select('products.*')
                        ->where('product_name', 'LIKE', '%'.$request->product.'%')
                        ->orWhere('price', 'LIKE', '%'.$request->product.'%')
                        ->orWhereHas('category', function($query) use($request){
                            $query->where('category', 'LIKE', '%'.$request->product.'%');
                        })->get();

        if ($search->isEmpty()) {
            if ($request->session()->get('product')) {
                return redirect()->intended('/product/search/results')->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'warning',
                    'message' => 'Product Not Found!'
                ]);
            }

            return redirect()->intended('/product')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'warning',
                'message' => 'Product Not Found!'
            ]);
        }

        session(['input' => $request->product, 'product' => array($search)]);
        
        return redirect()->intended('/product/search/results');
    }

    public function results(Request $request){
        return view('cashier.product.index')->with([
            'product' => $request->session()->get('product')
        ]);
    }
}