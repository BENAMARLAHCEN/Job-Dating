<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    public function announcements()
    {
        return $this->belongsToMany(Announcement::class, 'announce_skills');
    }
}
