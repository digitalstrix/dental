<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'clinic_id	',
        'meeting_id',
        'clinic_slot_id',
    ];

    use HasFactory;
    protected $table="jobs";
}