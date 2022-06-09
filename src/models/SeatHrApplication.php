<?php

namespace Cryocaustik\SeatHr\models;

use Illuminate\Database\Eloquent\Model;


class SeatHrApplication extends Model
{
    protected $fillable = [
        'corporation_id',
        'profile_id',
        'status_id',
        'can_reapply',
    ];

    protected $casts = [
        'can_reapply' => 'boolean',
    ];

    public function profile()
    {
        return $this->belongsTo(SeatHrProfile::class, 'profile_id');
//        return $this->hasOne(SeatHrProfile::class, 'id', 'profile_id');
    }

    public function corporation()
    {
        return $this->belongsTo(SeatHrCorporation::class, 'corporation_id');
    }

    public function status()
    {
        return $this->hasMany(SeatHrApplicationStatus::class, 'application_id')->with('status');
    }

    public function currentStatus()
    {
        return $this->hasOne(SeatHrApplicationStatus::class, 'application_id')
            ->where('active', true)
            ->with('status');
    }

    public function questions()
    {
        return $this->hasManyThrough(SeatHrQuestion::class, SeatHrAnswer::class, 'application_id', 'id', 'id', 'question_id');
    }

    public function answers()
    {
        return $this->hasMany(SeatHrAnswer::class, 'application_id', 'id')->with('question');
    }

    public function scopeView($query)
    {
        return $query->with(['answers:id,application_id,question_id,response', 'answers.question:id,name,type', 'status']);
    }
}
