<?php

namespace Cryocaustik\SeatHr\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Seat\Eveapi\Models\Corporation\CorporationInfo;


class SeatHrCorporation extends Model
{
    protected $fillable = [
        'corporation_id',
        'hr_head',
        'has_restricted_questions',
        'accepting_applications',
    ];

    public function corporation()
    {
        return $this->belongsTo(CorporationInfo::class, 'corporation_id');
    }

    public function questions()
    {
        return $this->hasMany(SeatHrCorporationQuestion::class, 'corporation_id');
    }

    public function applications()
    {
        return $this->hasManyThrough(SeatHrApplication::class,
            SeatHrCorporation::class,
            'id', 'corporation_id'
        );
    }

    public function getCanReapplyAttribute($query)
    {
        // if corporation does not have any applications, allow user to apply without further verif
        if($this->applications()->count() < 1) {
            return true;
        }
        // get user's profile id and check if their last (based on created_at) app allows re-apply
        $profile_id = User::find(Auth::user()->id)->profile->id;
        $applications = $this->applications()->where('profile_id', $profile_id)->latest('created_at');

        // if user does not have any applications, return true
        if($applications->count() < 1) {
            return true;
        }

        return $this->applications()->where('profile_id', $profile_id)
            ->latest('created_at')->first()->can_reapply;
    }

    public function getNameAttribute()
    {
        return $this->corporation->name;
    }

    public function scopeRecruiting($query)
    {
        return $query->where('accepting_applications', true);
    }
}
