<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminHasRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'role_id'
    ];
}
