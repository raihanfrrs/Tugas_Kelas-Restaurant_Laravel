<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.master.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.master.category.add-category');
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
            'category' => 'required|min:2|max:255|unique:categories',
            'status' => [new Enum(ServerStatus::class)]
        ]);

        $validateData['status'] = 'show';

        Category::create($validateData);

        return redirect()->intended('/category/create')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Add Category Success!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('administrator.master.category.detail-category')->with([
            'category' => $category,
            'subtitle' => $category->category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('administrator.master.category.edit-category')->with([
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'status' => 'required'
        ];

        if($request->category != $category->category){
            $rules['category'] = 'required|min:2|max:255|unique:categories';
        }

        if ($request->status == 'archive') {
            session(['archive' => $request->session()->get('archive')+1]);
        }

        if ($request->status == 'delete') {
            session(['recycle' => $request->session()->get('recycle')+1]);
        }

        $validateData = $request->validate($rules);

        Category::where('slug', $category->slug)->update($validateData);

        return redirect()->intended('/category')->with([
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        Category::where('slug', $category->slug)->update(['status' => 'delete']);

        session(['recycle' => $request->session()->get('recycle')+1]);

        return redirect()->intended('/category')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Delete Success!'
        ]);
    }

    public function dataCategory(){
        return DataTables::of(Category::query()->where('status', 'show'))
        ->addColumn('action', function ($model) {
            return view('administrator.master.category.form-action', compact('model'))->render();
        })
        ->make(true);
    }
}
