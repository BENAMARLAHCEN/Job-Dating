<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'announcement_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['announce'] ?? false) {
            $query->whereHas('announcement', function ($subQuery) {
                $subQuery->where('announcement_id', '=', request('announce'));
            });
        }
    }
}
