<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'level',
        'type',
        'description',
        'price',
        'picture',
        'hours',
        'validation',
    ];
  
    public function formateurs()
    {
        return $this->belongsToMany(Formateur::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'orders', 'course_id', 'user_id')
        ->withPivot('price')
        ->withTimestamps();
    }
}
