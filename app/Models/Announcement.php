<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title', 'description', 'date','image',
    ];

    public function company()
    {
        return $this->belongsToMany(Company::class,'announce_companies');
    }

    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'announce_skills');
    }

    // public function scopeFilter($query, array $filters) {
    //     if($filters['skill'] ?? false) {
    //         $query->where('skills', 'like', '%' . request('skill') . '%');
    //     }

    //     if($filters['search'] ?? false) {
    //         $query->where('title', 'like', '%' . request('search') . '%')
    //             ->orWhere('description', 'like', '%' . request('search') . '%')
    //             ->orWhere('skills.name', 'like', '%' . request('search') . '%');
    //     }
    // }
    public function scopeFilter($query, array $filters)
{
    if ($filters['skill'] ?? false) {
        $query->whereHas('skills', function ($subQuery) {
            $subQuery->where('name', 'like', '%' . request('skill') . '%');
        });
    }

    if ($filters['search'] ?? false) {
        $query->where(function ($subQuery) {
            $searchTerm = '%' . request('search') . '%';
            $subQuery->where('title', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm)
                ->orWhereHas('skills', function ($subSubQuery) use ($searchTerm) {
                    $subSubQuery->where('name', 'like', $searchTerm);
                });
        });
    }
}


}
