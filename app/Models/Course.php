<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['pivot'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class)
            ->withTimestamps();;
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class)
            ->withTimestamps();
    }
}
