<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'firstSurname',
        'secondSurname',
        'firstName',
        'secondName',
        'ci',
        'phone',
        'email',
        'profession',
        'professionOther',
        'departamento',
        'provincia',
        'direccion',
        'cursoTaller',
        'file',
        'file2',
        'observacion'
    ];
    protected $hidden = [
//        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
