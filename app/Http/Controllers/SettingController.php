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

    public function profile_update(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|min:2|max:255|unique:cashiers',
            'phone' => 'required|numeric|unique:cashiers',
            'email' => 'required|min:5|max:255|unique:cashiers|email:rfc,dns',
            'image' => 'image|file|max:2048',
            'username' => 'required|min:5|max:255|unique:users|alpha_num',
            'password' => ['required', Password::min(5)->mixedCase()->letters()->numbers()->symbols()->uncompromised()]
        ]);

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
