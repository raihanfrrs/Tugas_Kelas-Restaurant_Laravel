<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kitchen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules\Password;

class KitchenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.master.kitchen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.master.kitchen.add-kitchen');
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
            'name' => 'required|min:2|max:255|unique:kitchens',
            'phone' => 'required|numeric|unique:kitchens',
            'email' => 'required|min:5|max:255|unique:kitchens|email:rfc,dns',
            'image' => 'image|file|max:2048',
            'status' => [new Enum(ServerStatus::class)],
            'username' => 'required|min:5|max:255|unique:users|alpha_num',
            'password' => ['required', Password::min(5)->mixedCase()->letters()->numbers()->symbols()->uncompromised()]
        ]);

        $validateData['status'] = 'active';
        $validateData['level'] = 'kitchen';
        $validateData['password'] = bcrypt($validateData['password']);
        $user = User::create($validateData);

        $validateData['user_id'] = $user->id;
        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('kitchen-image');
        }

        Kitchen::create($validateData);

        return redirect()->intended('/kitchen/create')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Add Kitchen Success!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kitchen  $kitchen
     * @return \Illuminate\Http\Response
     */
    public function show(Kitchen $kitchen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kitchen  $kitchen
     * @return \Illuminate\Http\Response
     */
    public function edit(Kitchen $kitchen)
    {
        return view('administrator.master.kitchen.edit-kitchen')->with([
            'kitchen' => $kitchen
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kitchen  $kitchen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kitchen $kitchen)
    {
        $kitchens = [
            'image' => 'image|file|max:2048'
        ];

        if ($request->name != $kitchen->name) {
            $kitchens['name'] = 'required|min:2|max:255|unique:kitchens';
        }

        if ($request->phone != $kitchen->phone) {
            $kitchens['phone'] = 'required|numeric|unique:kitchens';
        }

        if ($request->email != $kitchen->email) {
            $kitchens['email'] = 'required|min:5|max:255|unique:kitchens|email:rfc,dns';
        }

        $validateData = $request->validate($kitchens);

        if ($request->file('image')) {
            if ($kitchen->image) {
                Storage::delete($kitchen->image);
            }
            $validateData['image'] = $request->file('image')->store('kitchen-image');
        }

        Kitchen::whereId($kitchen->id)->update($validateData);

        if ($request->username != $kitchen->user->username) {
            $users['username'] = 'required|min:5|max:255|unique:users|alpha_num';
        }

        if ($request->password != null) {
            $password['password'] = [Password::min(5)->mixedCase()->letters()->numbers()->symbols()->uncompromised()];
            
            User::whereId($kitchen->user_id)->update(['password' => Hash::make($request->password)]);
        }

        $users['status'] = 'required';

        User::whereId($kitchen->user_id)->update($request->validate($users));

        return redirect()->intended('/kitchen')->with([
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
     * @param  \App\Models\Kitchen  $kitchen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Kitchen $kitchen)
    {
        if (!$request->recycle) {
            User::whereId($kitchen->user_id)->update(['status' => 'non-active']);

            session(['recycle' => $request->session()->get('recycle')+1]);

            return redirect()->intended('/kitchen')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Delete Success!'
            ]);
        }
    }

    public function dataKitchen(){
        return DataTables::of(Kitchen::join('users', 'kitchens.user_id', '=', 'users.id')->select('kitchens.*')->where('status', 'active')->get())
        ->addColumn('action', function ($model) {
            return view('administrator.master.kitchen.form-action', compact('model'))->render();
        })
        ->make(true);
    }
}
