<?php

namespace Cryocaustik\SeatHr\models;

use Illuminate\Database\Eloquent\Model;

class SeatHrProfile extends Model
{
    protected $fillable = [ 'user_id', 'probation'];
    protected $casts = [
        'probation' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function applications()
    {
        return $this->hasMany(SeatHrApplication::class, 'profile_id', 'id');
    }
}
