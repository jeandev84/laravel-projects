<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    // ManyToOne
    public function category()
    {
         return $this->belongsTo('App\\Models\\Category');
    }
}
