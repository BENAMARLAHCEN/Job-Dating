<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title', 'description', 'date', 'company_id','image','skills',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'announce_skills');
    }

    public function scopeFilter($query, array $filters) {
        if($filters['skill'] ?? false) {
            $query->where('skills', 'like', '%' . request('skill') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('skills', 'like', '%' . request('search') . '%');
        }
    }

}
