<?php

namespace Cryocaustik\SeatHr\models;

use Illuminate\Database\Eloquent\Model;

class SeatHrQuestion extends Model
{
    //
    protected $fillable = [
        'name',
        'type',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function corporationsUsing()
    {
        return $this->hasMany(SeatHrCorporationQuestion::class, 'question_id', 'id');
    }
}
