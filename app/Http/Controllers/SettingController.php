<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Cashier;
use App\Models\Kitchen;
use App\Models\Setting;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            $admin = Admin::where('user_id', $id)->get();

            $admins = [
                'image' => 'image|file|max:2048'
            ];

            if ($request->name != $admin[0]->name) {
                $admins['name'] = 'required|min:2|max:255|unique:admins';
            }

            if ($request->email != $admin[0]->email) {
                $admins['email'] = 'required|min:5|max:255|unique:admins|email:rfc,dns';
            }

            if ($request->phone != $admin[0]->phone) {
                $admins['phone'] = 'required|numeric|unique:admins';
            }

            $validateData = $request->validate($admins);

            $validateData['slug'] = slug($request->name);

            if ($request->file('image')) {
                if ($admin[0]->image) {
                    Storage::delete($admin[0]->image);
                }
                $validateData['image'] = $request->file('image')->store('admin-image');
            }

            Admin::where('user_id', $id)->update($validateData);

            if ($request->username != auth()->user()->username) {
                $users['username'] = 'required|min:5|max:255|unique:users|alpha_num';

                User::findOrFail(auth()->user()->id)->update($request->validate($users));
            }

        } elseif (auth()->user()->level == 'cashier') {
            $cashier = Cashier::where('user_id', $id)->get();

            $cashiers = [
                'image' => 'image|file|max:2048'
            ];

            if ($request->name != $cashier[0]->name) {
                $cashiers['name'] = 'required|min:2|max:255|unique:cashiers';
            }

            if ($request->email != $cashier[0]->email) {
                $cashiers['email'] = 'required|min:5|max:255|unique:cashiers|email:rfc,dns';
            }

            if ($request->phone != $cashier[0]->phone) {
                $cashiers['phone'] = 'required|numeric|unique:cashiers';
            }

            $validateData = $request->validate($cashiers);

            $validateData['slug'] = slug($request->name);

            if ($request->file('image')) {
                if ($cashier[0]->image) {
                    Storage::delete($cashier[0]->image);
                }
                $validateData['image'] = $request->file('image')->store('cashier-image');
            }

            Cashier::where('user_id', $id)->update($validateData);

            if ($request->username != auth()->user()->username) {
                $users['username'] = 'required|min:5|max:255|unique:users|alpha_num';

                User::findOrFail(auth()->user()->id)->update($request->validate($users));
            }
        } elseif (auth()->user()->level == 'kitchen') {
            $kitchen = Kitchen::where('user_id', $id)->get();

            $kitchens = [
                'image' => 'image|file|max:2048'
            ];

            if ($request->name != $kitchen[0]->name) {
                $kitchens['name'] = 'required|min:2|max:255|unique:kitchens';
            }

            if ($request->email != $kitchen[0]->email) {
                $kitchens['email'] = 'required|min:5|max:255|unique:kitchens|email:rfc,dns';
            }

            if ($request->phone != $kitchen[0]->phone) {
                $kitchens['phone'] = 'required|numeric|unique:kitchens';
            }

            $validateData = $request->validate($kitchens);

            $validateData['slug'] = slug($request->name);

            if ($request->file('image')) {
                if ($kitchen[0]->image) {
                    Storage::delete($kitchen[0]->image);
                }
                $validateData['image'] = $request->file('image')->store('kitchen-image');
            }

            Kitchen::where('user_id', $id)->update($validateData);

            if ($request->username != auth()->user()->username) {
                $users['username'] = 'required|min:5|max:255|unique:users|alpha_num';

                User::findOrFail(auth()->user()->id)->update($request->validate($users));
            }
        }

        return redirect()->intended('/settings')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Update Success!'
        ]);
    }

    public function password_update(Request $request)
    {
        User::whereId(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
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

    public function check_password(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return "Invalid Password";
        }
    }
}
