<?php

namespace App\Models;

use App\Models\Cashier;
use App\Models\Customer;
use App\Models\DetailTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function cashier()
    {
        return $this->belongsTo(Cashier::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function detail_transaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
