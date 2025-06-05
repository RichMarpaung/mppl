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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->String('nama');
            $table->String('deskripsi');
            $table->timestamp('tanggal_selesai')->nullable();
            $table->String('file')->nullable();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->enum('status', ['pending', 'completed','revisi','accepted'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
