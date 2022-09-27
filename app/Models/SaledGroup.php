<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaledGroup extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }
}
