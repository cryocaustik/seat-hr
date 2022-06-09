<?php

namespace Cryocaustik\SeatHr\models;

use Illuminate\Database\Eloquent\Model;

class SeatHrBlacklist extends Model
{
    protected $fillable = [
        'profile_id',
        'blacklisted_by',
        'blacklisted_at',
        'reason',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
