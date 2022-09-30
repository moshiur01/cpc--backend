<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    use HasFactory;
    protected $table = 'flags';
    protected $fillable = [

        'uid',
        'website_update',
        'notifications',
        'new_user',
        'new_admin',
    ];
}
