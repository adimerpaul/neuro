<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'subtitle',
        'title',
        'avatar',
        'content',
        'button',
        'urlZoom',
        'urlYoutube',
        'date',
        'tipo',
        'diapositivas',
    ];
    protected $appends = [
        'hora','text'
    ];
    public function getHoraAttribute()
    {
        return substr($this->subtitle, 0, 5);
    }
    public function getTextAttribute()
    {
        return substr($this->subtitle, 5);
    }
}
