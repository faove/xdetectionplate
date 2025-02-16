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
        Schema::create('propietarios', function (Blueprint $table) {
            $table->id();
            $table->string('num_ndoc')->nullable();
            $table->string('num_cuit')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('domicilio')->nullable();
            $table->string('phone')->nullable();
            $table->string('obj_id', 8)->nullable(); //R0129777
            $table->string('num', 8)->nullable(); //P0376474            
            $table->string('status', 1)->nullable(); //P0376474            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propietarios');
    }
};
