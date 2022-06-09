<?php

namespace Cryocaustik\SeatHr\http\composers;

use Illuminate\Contracts\View\View;
use Cryocaustik\SeatHr\models\User;
use Seat\Eveapi\Models\Character\CharacterInfo;


class Profile
{
    private $character;

    public function __construct()
    {
        $character = request()->character;
        if(is_string($character)){
            $character = CharacterInfo::find($character);
        }

        $this->character = $character;
    }

    public function compose(View $view)
    {
        $view->with('character', $this->character);
        $view->with('seat_hr_user', User::find($this->character->user->id));
    }
}
