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
        Schema::create('tahap_lamarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')->constrained('pelamars')->onDelete('cascade');
            $table->foreignId('jadwal_tahap_id')->nullable()->constrained('jadwal_tahaps')->onDelete('set null');

            $table->string('tahap'); // contoh: screening_berkas, psikotes, wawancara_user
            $table->enum('hasil', ['pending', 'passed', 'failed'])->default('pending');
            $table->timestamp('dijadwalkan_pada')->nullable();
            $table->timestamp('selesai_pada')->nullable();
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahap_lamarans');
    }
};
