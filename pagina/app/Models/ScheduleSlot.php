<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleSlot extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'day_label',
        'day_key',
        'day_tag',
        'time_start',
        'time_end',
        'title',
        'description',
        'is_break',
        'sort_order',
    ];

    protected $casts = [
        'is_break' => 'boolean',
    ];
}
