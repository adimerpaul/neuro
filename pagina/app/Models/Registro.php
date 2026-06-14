<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'firstName', 'secondName', 'firstSurname', 'secondSurname',
        'ci', 'phone', 'email', 'profession', 'professionOther',
        'departamento', 'provincia', 'direccion',
        'cursoTaller', 'modalidad', 'ciudad',
        'file', 'file2', 'observacion', 'confirmado',
    ];

    protected $casts = [
        'confirmado' => 'boolean',
    ];

    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->firstName} {$this->secondName} {$this->firstSurname} {$this->secondSurname}");
    }
}
