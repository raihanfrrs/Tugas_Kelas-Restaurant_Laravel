<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Cashier;
use App\Models\Kitchen;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index');
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    public function profile_update(Request $request, $id)
    {
        if (auth()->user()->level == 'administrator') {
            $admin = Admin::findOrFail($id);

            $admins = [
                'image' => 'image|file|max:2048'
            ];

            if ($request->name != $admin->name) {
                $admins['name'] = 'required|min:2|max:255|unique:admins';
            }

            if ($request->) {
                # code...
            }

            $validateData = $request->validate([
                'phone' => 'required|numeric|unique:admins',
                'email' => 'required|min:5|max:255|unique:admins|email:rfc,dns',
                'username' => 'required|min:5|max:255|unique:users|alpha_num',
            ]);
        } elseif (auth()->user()->level == 'cashier') {
            $validateData = $request->validate([
                'name' => 'required|min:2|max:255|unique:cashiers',
                'phone' => 'required|numeric|unique:cashiers',
                'email' => 'required|min:5|max:255|unique:cashiers|email:rfc,dns',
                'username' => 'required|min:5|max:255|unique:users|alpha_num',
                'image' => 'image|file|max:2048'
            ]);
        } elseif (auth()->user()->level == 'kitchen') {
            $validateData = $request->validate([
                'name' => 'required|min:2|max:255|unique:kitchens',
                'phone' => 'required|numeric|unique:kitchens',
                'email' => 'required|min:5|max:255|unique:kitchens|email:rfc,dns',
                'username' => 'required|min:5|max:255|unique:users|alpha_num',
                'image' => 'image|file|max:2048'
            ]);
        }

        $validateData['status'] = 'active';
        $validateData['level'] = 'cashier';
        $validateData['password'] = bcrypt($validateData['password']);
        $user = User::create($validateData);

        $validateData['user_id'] = $user->id;
        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('cashier-image');
        }

        Cashier::create($validateData);

        return redirect()->intended('/cashier/create')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Add Cashier Success!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
