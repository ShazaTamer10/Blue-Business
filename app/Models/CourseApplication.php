<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseApplication extends Model
{
    use HasFactory;
    
    protected $fillable = ['course_id', 'name', 'email', 'phone', 'message'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

