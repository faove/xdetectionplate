<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patentes', function (Blueprint $table) {
            $table->id();
            $table->string('dominio', 9);            
            $table->date('fchregistro');            
            $table->integer('marca'); 
            $table->integer('modelo'); 
            $table->string('marca_name')->nullable();
            $table->string('modelo_name')->nullable();
            $table->string('nromotor')->nullable();
            $table->string('nrochasis')->nullable();
            $table->integer('anio');
            $table->string('color', 15)->nullable();
            $table->string('obj_id', 8)->nullable();
            $table->string('imagen')->nullable();
            $table->string('video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patentes');
    }
};
