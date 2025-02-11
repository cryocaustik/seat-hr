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

    public function scopeCorporationQuestions($query, $corporation_id)
    {
        return $query
        ->leftJoin(
            'seat_hr_corporation_questions',
            function ($join) use ($corporation_id) {
                $join->on('seat_hr_questions.id', '=', 'seat_hr_corporation_questions.question_id')
                    ->where('seat_hr_corporation_questions.corporation_id', $corporation_id);
            })
            // ->where('seat_hr_corporation_questions.corporation_id', $corporation_id)
            ->select(
                'seat_hr_questions.id',
                'seat_hr_questions.name',
                'seat_hr_questions.type',
                'seat_hr_questions.active',
                'seat_hr_corporation_questions.id as corporation_question_id',
                'seat_hr_corporation_questions.active as corporation_question_active',
            );
    }
}
