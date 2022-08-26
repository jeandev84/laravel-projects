<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    const PerPage = 10;

    protected $table = 'posts';

    protected $fillable = ['title', 'body'];



    /**
     * @return HasMany
    */
    public function comments()
    {
         return $this->hasMany(Comment::class);
    }
}
