<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Service::insert([
            [
                'nama' => 'Pembuatan Website Company Profile',
                'deskripsi' => 'Layanan pembuatan website profesional untuk profil perusahaan Anda.',
                'harga' => 3500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Jasa Desain Logo',
                'deskripsi' => 'Desain logo kreatif dan modern sesuai kebutuhan bisnis Anda.',
                'harga' => 750000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Digital Marketing',
                'deskripsi' => 'Strategi pemasaran digital untuk meningkatkan visibilitas bisnis Anda.',
                'harga' => 2500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pembuatan Aplikasi Mobile',
                'deskripsi' => 'Pengembangan aplikasi mobile Android dan iOS sesuai permintaan.',
                'harga' => 5000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Jasa Maintenance Website',
                'deskripsi' => 'Perawatan dan update website agar tetap optimal dan aman.',
                'harga' => 1000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
