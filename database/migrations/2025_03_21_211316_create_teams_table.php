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
            $table->string('ktp')->nullable();
            $table->string('npwp')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('image')->nullable();
            $table->string('cv')->nullable();
            $table->string('pengalaman')->nullable();
            $table->string('posisi');
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
