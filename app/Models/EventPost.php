<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPost extends Model
{
    use HasFactory;
    protected $table = 'event_posts';
    protected $fillable = [

        'event_id',
        'title',
        'start_date',
        'end_date',
        'description',
        'cover_image',
    ];
}
