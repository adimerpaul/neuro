<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceTier extends Model
{
    protected $fillable = [
        'event',
        'category',
        'price',
        'note',
        'sort_order',
    ];
}
