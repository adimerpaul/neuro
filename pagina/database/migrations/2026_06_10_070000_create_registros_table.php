<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('secondName')->nullable();
            $table->string('firstSurname');
            $table->string('secondSurname')->nullable();
            $table->string('ci')->nullable();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('profession');
            $table->string('professionOther')->nullable();
            $table->string('departamento')->nullable();
            $table->string('provincia')->nullable();
            $table->string('direccion')->nullable();
            $table->string('cursoTaller')->nullable();
            $table->string('modalidad')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('file')->nullable();
            $table->string('file2')->nullable();
            $table->text('observacion')->nullable();
            $table->boolean('confirmado')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
