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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('ktp', 50)->nullable();
            $table->string('npwp', 50)->nullable();
            $table->string('ijazah', 255)->nullable();

            $table->string('image', 50)->nullable();
            $table->string('cv', 50)->nullable();
            $table->string('posisi',50);
            $table->enum('status', ['Tetap', 'freelance']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
