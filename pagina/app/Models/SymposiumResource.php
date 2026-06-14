<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SymposiumResource extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'type',
        'url',
        'file_path',
        'is_public',
        'sort_order',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];
}
