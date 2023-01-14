<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function tax_index()
    {
        return view('administrator.service.tax.index');
    }

    public function tax_store(Request $request)
    {
        $tax = Tax::where('tax', $request->tax)->get();
        
        if ($tax->isEmpty()) {
            $validateData = $request->validate([
                'tax' => 'required|numeric'
            ]);

            $validateData['status'] = 'non-active';

            Tax::create($validateData);

            return redirect()->intended('/service/tax')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Tax Added Successfuly!'
            ]);
        }

        return redirect()->intended('/service/tax')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'error',
            'message' => 'Tax Already Exist!'
        ]);
    }

    public function tax_update(Tax $tax)
    {
        if ($tax->status === 'active') {
            Tax::find($tax->id)->update(['status' => 'non-active']);

            return redirect()->intended('/service/tax')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Tax Successfully Non-Activated!'
            ]);
        }

        if (Tax::where('status', 'active')->count() < 1) {
            Tax::find($tax->id)->update(['status' => 'active']);

            return redirect()->intended('/service/tax')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Tax Successfully Activated!'
            ]);
        }

        return redirect()->intended('/service/tax')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'error',
            'message' => 'Another Tax Currently Active!'
        ]);
    }

    public function dataTax(){
        return DataTables::of(Tax::all())
        ->addColumn('action', function ($model) {
            return view('administrator.service.tax.form-action', compact('model'))->render();
        })
        ->make(true);
    }
}