<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockIp extends Model
{
    use HasFactory;

    const ACTION_BLOCK_LOGIN_NAME = 'login';
    const LIMIT_NUM_FAILS = 10;

    protected $fillable = [
        'ip',
        'detail',
        'action_block',
        'num_fails',
    ];
}
