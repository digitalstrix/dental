<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Provider extends Authenticatable
{
    protected $guard="provider";
    protected $fillable = [
        'name',
        'email',
        'profile',
        'mobile',
        'user_type',
    ];

    use HasFactory;
    protected $table="providers";
}
