<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TempCart extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    public $incrementing = false;

    protected $keyType = 'integer';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected $guarded = [
        'id'
    ];

}
