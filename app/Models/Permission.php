<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    const LIST_PERMISSION_REFERENCE = [
        '.create' => '.store',
        '.edit'   => '.update'
    ];

    const LIST_PERMISSION_CHECK = [
        'create',
        'store',
        'edit',
        'update',
        'delete',
    ];
}
