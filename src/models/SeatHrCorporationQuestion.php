<?php

namespace Cryocaustik\SeatHr\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeatHrCorporationQuestion extends Model
{
    protected $fillable = [
        'corporation_id',
        'question_id',
        'active',
    ];

    public function corporation()
    {
        return $this->belongsTo(SeatHrCorporation::class, 'corporation_id');
    }

    public function question()
    {
        return $this->belongsTo(SeatHrQuestion::class, 'question_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeQuestions($query, $corporation_id)
    {
        return $query
            ->rightJoin(
                'seat_hr_questions',
                'seat_hr_questions.id',
                'seat_hr_corporation_questions.question_id',
            )
            ->where('corporation_id', $corporation_id)
            ->orWhereNotNull('seat_hr_questions.id')
            ->select(
                'seat_hr_corporation_questions.id',
                'seat_hr_corporation_questions.corporation_id',
                'seat_hr_questions.id as question_id',
                'seat_hr_questions.name as question_name',
                'seat_hr_questions.type as question_type',
                'seat_hr_corporation_questions.active as active',
                DB::raw('if(seat_hr_corporation_questions.id is null, 0, 1) as used'),
            );
    }
}
