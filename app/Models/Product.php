<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function worker()
    {
        return $this->belongsTo(Worker::class, 'postedBy');
    }
}
