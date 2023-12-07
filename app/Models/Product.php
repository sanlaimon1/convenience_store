<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(Type $var = null)
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function brand(Type $var = null)
    {
        return $this->belongsTo('App\Models\Brand');
    }
}
