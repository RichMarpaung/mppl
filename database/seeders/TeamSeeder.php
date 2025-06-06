<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::insert([
            [
                'user_id' => 23, // Ganti dengan ID user yang sesuai
                'posisi' => 'Backend Developer',
                'status' => 'Tetap',
                'pengalaman' => 'Sebagai programmer backend, aku merancang logika, database, dan API di balik layar. Meski tak terlihat, satu bug bisa bikin sistem kacau. Tapi justru di situlah tantangannya—membangun fondasi kuat agar aplikasi berjalan lancar tanpa drama',
                'ktp' => 'uploads/ktp/T7JBFmFgAprIJmcIHOO5pYzK8CxYNIIeGpjRiIKq.jpg', // Ganti dengan path file KTP jika ada
                'npwp' => 'uploads/npwp/mygILpm2Mef9dZAlBdnbUjiclXxoL0oG5vpUdEfs.jpg', // Ganti dengan path file NPWP jika ada
                'ijazah' => 'uploads/ijazah/DLW6WbY6V3WQhrG6Qynla5NNfe23txUedjzIx6Al.jpg', // Ganti dengan path file Ijazah jika ada
                'cv' => 'uploads/cv/cX87km4HQr1kR6pqxHEw1w6ZndmMunGVJKARzM0a.jpg', // Ganti dengan path file CV jika ada
                'image' => 'uploads/image/5K2hG3Sgy9FUhvvTj8u57IRU4lUNp8ephGD8PGof.jpg', // Ganti dengan path file gambar jika ada
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data tim lainnya sesuai kebutuhan
        ]);
    }
}
