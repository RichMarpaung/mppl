<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\TahapLamaran;
use App\Models\JadwalTahap;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class PelamarProcessController extends Controller
{
    /**
     * Urutan tahap & kuota default per hari.
     * Sesuaikan jika alur berubah.
     */
    public const FLOW = [
        'screening_berkas' => ['next' => 'psikotes',       'quota' => 20],
        'psikotes'         => ['next' => 'wawancara_hr',   'quota' => 20],
        'wawancara_hr'     => ['next' => 'offering',       'quota' => 5],
        'offering'         => ['next' => 'DITERIMA',       'quota' => 0],
    ];

    /** ----------------------------------------------------------------
     *  === 1. ACC berkas  =============================================
     *  Pelamar lulus screening → masuk FLOW berikutnya otomatis.
     *  ---------------------------------------------------------------- */
    public function approveBerkas(Pelamar $pelamar): RedirectResponse
    {
        return $this->lanjutkanTahap($pelamar, 'screening_berkas', 'Berkas disetujui.');
    }

    /** ----------------------------------------------------------------
     *  === 2. Mark LULUS tahap tertentu  ================================
     *  Bisa dipakai di setiap halaman tahap (psikotes, wawancara, …).
     *  ---------------------------------------------------------------- */
    public function lulus(Pelamar $pelamar, TahapLamaran $tahap): RedirectResponse
    {
        $this->validasiTahap($pelamar, $tahap);

        $tahap->update([
            'hasil'        => 'passed',
            'selesai_pada' => now(),
        ]);

        return $this->lanjutkanTahap($pelamar, $tahap->tahap, 'Tahap berhasil dilalui.');
    }

    /** ----------------------------------------------------------------
     *  === 3. Mark GAGAL / Tolak  =====================================
     *  ---------------------------------------------------------------- */
    public function gagal(Pelamar $pelamar, $tahapIdOrKey): RedirectResponse
    {
        // Jika ditolak saat seleksi berkas
        if ($pelamar->status === 'menunggu' && $tahapIdOrKey === 'berkas') {
            $pelamar->update([
                'status' => 'ditolak',
                'keterangan_penolakan' => 'Berkas Anda tidak memenuhi kriteria seleksi administrasi.',
            ]);
            return back()->with('danger', 'Berkas pelamar ditolak.');
        }

        $tahap = TahapLamaran::findOrFail($tahapIdOrKey);
        $this->validasiTahap($pelamar, $tahap);

        // Tentukan alasan berdasarkan tahap
        $alasan = match ($tahap->tahap) {
            'psikotes'       => 'Anda tidak lolos tahap psikotes.',
            'wawancara_hr'   => 'Anda tidak lolos wawancara HRD.',
            'wawancara_user' => 'Anda tidak lolos wawancara divisi.',
            'offering'       => 'Proses penawaran tidak berhasil.',
            default          => 'Anda tidak lolos proses seleksi.',
        };

        // Update tahap & pelamar
        $tahap->update([
            'hasil'        => 'failed',
            'selesai_pada' => now(),
        ]);

        $pelamar->update([
            'status' => 'ditolak',
            'keterangan_penolakan' => $alasan,
        ]);

        return back()->with('danger', 'Pelamar ditolak pada tahap: ' . $tahap->tahap);
    }

    /** ----------------------------------------------------------------
     *  === 4. Helper lanjutan tahap  ===================================
     *  ---------------------------------------------------------------- */
    private function lanjutkanTahap(Pelamar $pelamar, string $currentStage, string $pesan)
    {
        $flow = self::FLOW[$currentStage] ?? null;
        if (!$flow) {
            return back()->with('warning', 'Tahap tidak dikenali.');
        }

        // Apabila mencapai akhir FLOW
        if ($flow['next'] === 'DITERIMA') {
            $pelamar->update(['status' => 'diterima']);
            return back()->with('success', $pesan . ' Pelamar dinyatakan DITERIMA.');
        }

        DB::transaction(function () use ($pelamar, $flow) {
            $jadwal = $this->jadwalkan(
                $pelamar->lowongan_id,
                $flow['next'],
                $flow['quota']
            );

            $pelamar->tahapLamarans()->create([
                'tahap'            => $flow['next'],
                'hasil'            => 'pending',
                'dijadwalkan_pada' => $jadwal->tanggal,
                'jadwal_tahap_id'  => $jadwal->id,
            ]);

            $jadwal->increment('kuota_terpakai');
            $pelamar->update(['status' => $flow['next']]);
        });

        return back()->with('success', $pesan . ' Pelamar dijadwalkan ke tahap: ' . $flow['next']);
    }

    /** ----------------------------------------------------------------
     *  === 5. Buat / ambil jadwal + kuota  =============================
     *  ---------------------------------------------------------------- */
    private function jadwalkan(int $lowonganId, string $tahap, int $quotaDefault): JadwalTahap
    {
        // Kunci untuk race‑condition kuota
        return DB::transaction(function () use ($lowonganId, $tahap, $quotaDefault) {
            $jadwal = JadwalTahap::where('lowongan_id', $lowonganId)
                ->where('tahap', $tahap)
                ->whereColumn('kuota_terpakai', '<', 'kuota_max')
                ->orderBy('tanggal')
                ->lockForUpdate()
                ->first();

            if ($jadwal) {
                return $jadwal;
            }
            $tanggalBaru = Carbon::now()
                ->startOfWeek()          // Senin minggu ini
                ->addWeek()              // → Senin minggu depan
                ->toDateString();        // YYYY‑MM‑DD

            return JadwalTahap::create([
                'lowongan_id'     => $lowonganId,
                'tahap'           => $tahap,
                'tanggal'         => $tanggalBaru,
                'kuota_max'       => $quotaDefault,
                'kuota_terpakai'  => 0,
            ]);
        });
    }

    /** ----------------------------------------------------------------
     *  === 6. Validasi kepemilikan tahap  ==============================
     *  ---------------------------------------------------------------- */
    private function validasiTahap(Pelamar $pelamar, TahapLamaran $tahap): void
    {
        abort_if($tahap->pelamar_id !== $pelamar->id, 403, 'Tahap tidak sesuai pelamar.');
        abort_if($tahap->hasil !== 'pending', 409, 'Tahap sudah selesai.');
    }
}
