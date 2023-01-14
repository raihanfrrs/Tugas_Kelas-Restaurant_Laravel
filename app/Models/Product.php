<?php

namespace App\Models;

use App\Models\Category;
use App\Models\TempCart;
use App\Models\DetailTransaction;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tempcart()
    {
        return $this->hasOne(TempCart::class);
    }

    public function detail_transaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'product_name'
            ]
        ];
    }
}