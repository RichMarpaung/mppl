<?php

namespace Database\Seeders;

use App\Models\Lowongan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Lowongan::insert([
            [
                'nama' => 'Teknisi Software',
                'deskripsi' => 'Kami mencari Teknisi Software yang kompeten untuk menangani instalasi, perawatan sistem, analisis kebutuhan perangkat lunak, dan dukungan teknis dalam operasional harian perusahaan.',
                'kualifikasi' => 'Lulusan SMK/D3/S1 di bidang Teknik Informatika atau Sistem Informasi. Memahami troubleshooting komputer dan jaringan dasar. Mampu membuat flowchart atau dokumentasi sistem. Komunikatif, teliti, dan mampu bekerja secara mandiri maupun tim. Pengalaman minimal 1 tahun (nilai tambah).',
                'gaji' => 6000000,
                'tanggal_ditutup' => '2024-12-31',
                'status' => 'dibuka',
                'poster' => 'posters/6TI3l08zEsdE7Zvyh7On0rpjh61PBIuMsXkWv1Sc.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
