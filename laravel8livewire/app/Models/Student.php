<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    const PerPage = 10;

    protected $table = "students";

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone'
    ];
}
