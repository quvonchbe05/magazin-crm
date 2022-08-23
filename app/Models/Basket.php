<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $table = "baskets";
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
