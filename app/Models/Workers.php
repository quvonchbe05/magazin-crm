<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    use HasFactory;
    protected $table = 'workers';
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
