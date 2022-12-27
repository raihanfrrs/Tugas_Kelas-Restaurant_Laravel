<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cashier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules\Password;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.master.cashier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.master.cashier.add-cashier');
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
            'name' => 'required|min:2|max:255|unique:cashiers',
            'phone' => 'required|numeric|unique:cashiers',
            'email' => 'required|min:5|max:255|unique:cashiers|email:rfc,dns',
            'image' => 'image|file|max:2048',
            'status' => [new Enum(ServerStatus::class)],
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
     * Display the specified resource.
     *
     * @param  \App\Models\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function show(Cashier $cashier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function edit(Cashier $cashier)
    {
        return view('administrator.master.cashier.edit-cashier')->with([
            'cashier' => $cashier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cashier $cashier)
    {
        $cashiers = [
            'image' => 'image|file|max:2048'
        ];

        if ($request->name != $cashier->name) {
            $cashiers['name'] = 'required|min:2|max:255|unique:cashiers';
        }

        if ($request->phone != $cashier->phone) {
            $cashiers['phone'] = 'required|numeric|unique:cashiers';
        }

        if ($request->email != $cashier->email) {
            $cashiers['email'] = 'required|min:5|max:255|unique:cashiers|email:rfc,dns';
        }

        $validateData = $request->validate($cashiers);

        if ($request->file('image')) {
            if ($cashier->image) {
                Storage::delete($cashier->image);
            }
            $validateData['image'] = $request->file('image')->store('cashier-image');
        }

        Cashier::whereId($cashier->id)->update($validateData);

        if ($request->username != $cashier->user->username) {
            $users['username'] = 'required|min:5|max:255|unique:users|alpha_num';
        }

        if ($request->password != null) {
            $password['password'] = [Password::min(5)->mixedCase()->letters()->numbers()->symbols()->uncompromised()];
            
            User::whereId($cashier->user_id)->update(['password' => Hash::make($request->password)]);
        }

        $users['status'] = 'required';

        User::whereId($cashier->user_id)->update($request->validate($users));

        return redirect()->intended('/cashier')->with([
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
     * @param  \App\Models\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cashier $cashier)
    {
        User::whereId($cashier->user_id)->update(['status' => 'non-active']);

        session(['recycle' => $request->session()->get('recycle')+1]);

        return redirect()->intended('/cashier')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Delete Success!'
        ]);
    }

    public function dataCashier(){
        return DataTables::of(Cashier::join('users', 'cashiers.user_id', '=', 'users.id')->select('cashiers.*')->where('status', 'active')->get())
        ->addColumn('action', function ($model) {
            return view('administrator.master.cashier.form-action', compact('model'))->render();
        })
        ->make(true);
    }
}
