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


    public function skills()
    {
        return $this->morphToMany(Skill::class, 'model_has_skills');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function hasUserRecordedAttendance($userId)
    {
        return $this->attendances()->where('user_id', $userId)->exists();
    }

    public function unrecordAttendance($userId)
    {
        $this->attendances()->where('user_id', $userId)->delete();
    }


    public function scopeFilter($query, array $filters)
{
    if ($filters['skill'] ?? false) {
        $query->whereHas('skill', function ($subQuery) {
            $subQuery->where('name', 'like', '%' . request('skill') . '%');
        });
    }

    if ($filters['search'] ?? false) {
        $query->where(function ($subQuery) {
            $searchTerm = '%' . request('search') . '%';
            $subQuery->where('title', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm)
                ->orWhereHas('skill', function ($subSubQuery) use ($searchTerm) {
                    $subSubQuery->where('name', 'like', $searchTerm);
                });
        });
    }
}


}
