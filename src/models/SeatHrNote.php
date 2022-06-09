<?php

namespace Cryocaustik\SeatHr\models;

use Illuminate\Database\Eloquent\Model;

class SeatHrNote extends Model
{
    protected $fillable = [
        'profile_id',
        'created_by',
        'severity',
        'note',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
