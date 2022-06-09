<?php

namespace Cryocaustik\SeatHr\http\controllers;

use Cryocaustik\SeatHr\http\datatables\CorporationDataTable;
use Cryocaustik\SeatHr\models\SeatHrCorporation;
use \Seat\Web\Http\Controllers\Controller;


class SeatHrController extends Controller
{
    public function about()
    {
        return view('seat-hr::about');
    }

    public function config(CorporationDataTable $dataTable)
    {
        return $dataTable->render('seat-hr::configuration.config');
    }
}
