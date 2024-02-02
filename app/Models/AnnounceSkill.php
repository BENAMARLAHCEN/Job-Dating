<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnounceSkill extends Model
{
    use HasFactory;
    protected $fillable = [
        'skill_id', 'announcement_id',
    ];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
