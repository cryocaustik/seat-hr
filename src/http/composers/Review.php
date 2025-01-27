<?php

namespace Cryocaustik\SeatHr\http\composers;

use Cryocaustik\SeatHr\models\SeatHrCorporation;
use Illuminate\Contracts\View\View;

class Review
{
    public function __construct()
    {
    }

    public function compose(View $view): void
    {
        $view->with('registered_corporations', SeatHrCorporation::all()->pluck('name', 'id'));
    }
}
