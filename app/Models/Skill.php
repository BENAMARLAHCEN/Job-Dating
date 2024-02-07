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



    public function users()
    {
        return $this->morphedByMany(User::class, 'model_has_skills');
    }

    public function announcement()
    {
        return $this->morphedByMany(Announcement::class, 'model_has_skills');
    }
}
