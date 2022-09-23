<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $table = 'certificates';
    protected $fillable = [

        'certificate_id',
        'stu_id',
        'stu_name',
        'stu_email',
        'program_name',
        'approved_by',
        'certificate_image',
    ];
}
