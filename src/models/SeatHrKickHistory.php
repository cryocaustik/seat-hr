<?php

namespace Cryocaustik\SeatHr\models;

use Illuminate\Database\Eloquent\Model;

class SeatHrKickHistory extends Model
{
    protected $fillable = [
        'profile_id',
        'kicked_by',
        'kicked_at',
        'reason',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
