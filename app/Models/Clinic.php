<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $guard="clinic";
    protected $fillable = [
        'name',
        'email',
        'image',
        'mobile',
        'password'
    ];

    use HasFactory;
    protected $table="clinics";
}
