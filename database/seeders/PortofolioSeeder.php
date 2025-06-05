<?php

namespace Database\Seeders;

use App\Models\Portofolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Portofolio::insert([
            [
                'nama' => 'Sistem Informasi Hukum (SISKUM)',
                'mitra' => 'Bagian Hukum & Perundang-undangan Polewali Mandar',
                'lokasi' => 'Polewali Mandar, Sulawesi Barat',
                'waktu' => '2013-04-01',
                'detail' => 'SISKUM adalah sebuah sistem informasi yang dirancang untuk mendata, menyimpan, dan mengelola berbagai produk hukum daerah seperti peraturan daerah, peraturan bupati, keputusan, dan dokumen hukum lainnya secara elektronik. Tujuannya adalah untuk memudahkan pengelolaan dan pencarian dokumen hukum oleh instansi terkait serta mendukung keterbukaan informasi hukum.',
                'image_mitra' => 'portofolio/mitra/2tcZHCbHtGuWgq4FyeR4CnKgkssYpTIK0YI7u89p.jpg',
                'image' => null,
                'link' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Website Jaringan Dokumentasi & Informasi Hukum (JDIH)',
                'mitra' => 'Bagian Hukum & Perundang-undangan Polewali Mandar',
                'lokasi' => 'Polewali Mandar, Sulawesi Barat',
                'waktu' => '2013-04-01',
                'detail' => 'JDIH adalah portal berbasis web yang merupakan bagian dari jaringan nasional dokumentasi dan informasi hukum. Tujuannya adalah menyediakan akses terbuka terhadap peraturan perundang-undangan yang berlaku di daerah, agar masyarakat dan lembaga pemerintah dapat memperoleh informasi hukum yang akurat, lengkap, dan terpercaya.',
                'image_mitra' => 'portofolio/mitra/2tcZHCbHtGuWgq4FyeR4CnKgkssYpTIK0YI7u89p.jpg',
                'image' => null,
                'link' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'nama' => 'Bimtek LPPD & LKPJ Desa, Lurah dan Camat',
            //     'mitra' => 'BPMPD Kab. Majene',
            //     'lokasi' => 'Bandung',
            //     'waktu' => '2013-10-01',
            //     'detail' => 'Bimbingan Teknis (Bimtek) LPPD & LKPJ yang berfokus pada peningkatan kapasitas aparatur desa, lurah, dan camat dalam menyusun Laporan Penyelenggaraan Pemerintahan Daerah (LPPD) dan Laporan Keterangan Pertanggungjawaban (LKPJ). LPPD dan LKPJ merupakan laporan resmi kepala daerah yang digunakan sebagai bahan evaluasi kinerja pemerintahan di tingkat lokal.',
            //     'image_mitra' => 'portofolio/mitra/8p57yCb4mR6ATQQBjRNkFeSgktjNZ3McjyEV8bHf.png',
            //     'image' => null,
            //     'link' => null,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'nama' => 'Bimtek Sistem Informasi Keuangan Daerah Kab. Mamuju',
                'mitra' => 'Badan Perencanaan Anggaran & Aset Daerah Mamuju',
                'lokasi' => 'BPKAD Kab. Mamuju',
                'waktu' => '2013-10-01',
                'detail' => 'Bimbingan Teknis untuk Sistem Informasi Keuangan Daerah, yaitu pelatihan dan pendampingan teknis dalam penggunaan aplikasi atau sistem berbasis komputer yang membantu pemerintah daerah dalam pengelolaan keuangan, seperti penyusunan anggaran, pelaporan keuangan, dan pengawasan aset secara transparan dan efisien.',
                'image_mitra' => 'portofolio/mitra/F6ALaVz1HdtktpjSa8W0AJGCM4A6xcxTIyYEUVqH.jpg',
                'image' => null,
                'link' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
