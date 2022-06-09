<?php

namespace Cryocaustik\SeatHr\models;

use Illuminate\Database\Eloquent\Model;

class SeatHrStatus extends Model
{
    protected $fillable = ['name', 'color', 'active'];
}
