<?php

namespace Cryocaustik\SeatHr\models;

use \Illuminate\Database\Eloquent\Model;

class SeatHrApplicationStatus extends Model
{
    protected $fillable = ['application_id', 'status_id', 'assigned_to', 'assigned_by', 'decision_by', 'active'];
    protected $casts = [
        'active' => 'boolean',
    ];

    public function status()
    {
        return $this->belongsTo(SeatHrStatus::class, 'status_id');
    }

    public function asignee()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function asigner()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function decider()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function getNameAttribute()
    {
        return $this->status->name;
    }

    public function getColorAttribute()
    {
        return $this->status->color;
    }

    public function getAssignedToNameAttribute()
    {
        return $this->asignee->name;
    }

    public function getAssignerNameAttribute()
    {
        return $this->asignee ? $this->asignee->name : '';
    }

    public function getDeciderNameAttribute()
    {
        return $this->asignee->name;
    }

    public function scopeCurrentStatus($query)
    {
        return $query->where('active', 1);
    }
}
