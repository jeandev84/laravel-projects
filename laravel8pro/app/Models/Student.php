<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';


    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone'
    ];


    // MUTATOR
    public function setEmailAttribute($value)
    {
         $this->attributes['email'] = strtolower($value);
    }


    // ACCESSOR NAME
    public function getNameAttribute($value)
    {
         return strtoupper($value);
    }


    // ACCESSOR EMAIl
    public function getEmailAttribute($value)
    {
        return strtoupper($value);
    }

}
