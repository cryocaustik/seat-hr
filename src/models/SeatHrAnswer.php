<?php

namespace Cryocaustik\SeatHr\models;

use Illuminate\Database\Eloquent\Model;

class SeatHrAnswer extends Model
{
    protected $fillable = [
        'application_id',
        'question_id',
        'response',
    ];

    public function question()
    {
        return $this->belongsTo(SeatHrQuestion::class);
    }

    public function application()
    {
        return $this->belongsTo(SeatHrApplication::class, 'application_id');
    }
}
