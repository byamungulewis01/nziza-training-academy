<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSubscriber extends Model
{
    use HasFactory;
    protected $fillable = [
        'trainee_id',
        'course_id',
        'start_date',
        'end_date',
        'status',
    ];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
}
