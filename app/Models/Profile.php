<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bio',
        'birthday',
        'mobile',
        'location',
        'job',
        'address',
        'linkedin',
        'github',
        'facebook',
        'instagram',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
