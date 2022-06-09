<?php

namespace Cryocaustik\SeatHr\http\controllers\user;

use Cryocaustik\SeatHr\models\SeatHrProfile;
use Cryocaustik\SeatHr\models\User;
use Illuminate\Support\Facades\Auth;
use Seat\Eveapi\Models\Character\CharacterInfo;
use \Seat\Web\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index($character = null)
    {
        if (!$character) {
            $profile = SeatHrProfile::firstOrCreate([ 'user_id' =>Auth::user()->id ]);
            $character = $profile->user->main_character_id;
        }

        return redirect()->route('seat-hr.profile.sheet', ['character' => $character]);
    }

    public function intel()
    {
        return view('seat-hr::user.intel');
    }

    public function sheet()
    {
        return view('seat-hr::user.sheet');
    }
}
