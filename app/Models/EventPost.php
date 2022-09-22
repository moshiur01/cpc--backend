<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPost extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [

        'event_id',
        'title',
        'start_date',
        'end_date',
        'description',
        'cover_image',
        'author_id',
    ];
}
