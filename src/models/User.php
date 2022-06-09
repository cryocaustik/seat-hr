<?php

namespace Cryocaustik\SeatHr\models;

use \Seat\Web\models\User as SeatUser;


class User extends SeatUser
{
    protected $table = 'users';

    public function profile()
    {
        return $this->hasOne(SeatHrProfile::class, 'user_id', 'id');
    }

    public function applications()
    {
        return $this->hasManyThrough(SeatHrApplication::class, SeatHrProfile::class, 'user_id', 'profile_id', 'id', 'id')
            ->with('status');
    }

    public function kickHistory()
    {
        return $this->hasManyThrough(SeatHrKickHistory::class, SeatHrProfile::class, 'user_id', 'profile_id', 'id', 'id');
    }

    public function blacklists()
    {
        return $this->hasManyThrough(SeatHrBlacklist::class, SeatHrProfile::class, 'user_id', 'profile_id', 'id', 'id');
    }

    public function notes()
    {
        return $this->hasManyThrough(SeatHrNote::class, SeatHrProfile::class, 'user_id', 'profile_id', 'id', 'id');
    }
}
