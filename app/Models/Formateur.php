<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;
    protected $fillable = [
        'formateur_id',
        'specialty',
        'biography',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
