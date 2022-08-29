<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPost extends Model
{
    use HasFactory;
    protected $table = 'event_posts';
    protected $fillable = [

        'eventID',
        'title',
        'startDate',
        'endDate',
        'description',
        'coverImage',
    ];
}
