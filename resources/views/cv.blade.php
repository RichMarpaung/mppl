<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CV TANNIEWA PUTRA Generator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/stylecv.css') }}" />
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  </head>
  <body>
    <div id="input-panel">
      <h2>Input Data CV</h2>
      <a href="{{ route('user.profile') }}" class="btn btn-secondary" style="margin-bottom: 1rem; display: inline-block;">
    <i class="fas fa-arrow-left"></i> Kembali ke Profil
  </a>
      <div class="form-group">
        <label for="input-photo">Upload Foto Profil:</label>
        <input type="file" id="input-photo" accept="image/*" />
        <span class="helper-text">Pilih foto profil (jpg/png).</span>
      </div>
      <div class="form-group">
        <label for="input-job-title">Jabatan:</label>
        <input type="text" id="input-job-title" placeholder="Contoh: DIREKTUR | SENIOR SISTEM ANALYST" value="" />
        <span class="helper-text">Masukkan jabatan Anda saat ini atau yang terakhir.</span>
      </div>
      <div class="form-group">
        <label for="input-full-name">Nama Lengkap & Gelar:</label>
        <input type="text" id="input-full-name" placeholder="Contoh: Dr. Ir. Adam M Tanniewa, S.Kom., S.E., M.M., M.T." value="" />
        <span class="helper-text">Isi nama lengkap Anda beserta gelar akademik jika ada.</span>
      </div>
      <div class="form-group">
        <label for="input-birth-info">Tempat, Tanggal Lahir:</label>
        <input type="text" id="input-birth-info" placeholder="Contoh: Polewali, 31 Desember 1976" value="" />
        <span class="helper-text">Format: Kota, DD Bulan YYYY (contoh: Jakarta, 01 Januari 1990).</span>
      </div>
      <div class="form-group">
        <label for="input-email">Email:</label>
        <input type="text" id="input-email" placeholder="Contoh: nama.anda@email.com" value="" />
        <span class="helper-text">Masukkan alamat email aktif Anda.</span>
      </div>
      <div class="form-group">
        <label for="input-phone">Telepon:</label>
        <input type="text" id="input-phone" placeholder="Contoh: +62-8123-4567-890" value="" />
        <span class="helper-text">Masukkan nomor telepon Anda.</span>
      </div>
      <div class="form-group">
        <label for="input-address">Alamat:</label>
        <input type="text" id="input-address" placeholder="Contoh: Manding, Polewali, Polewali Mandar" value="" />
        <span class="helper-text">Isi alamat domisili Anda saat ini (opsional detail).</span>
      </div>
      <h3>Pendidikan Formal</h3>
      <div id="education-inputs">
        <div class="form-group education-item-input">
          <input type="text" placeholder="Contoh: Universitas Muslim Indonesia - S3" value="" />
          <span class="helper-text">Format: Nama Institusi - Tingkat (contoh: Universitas ABC - S1). Gunakan "-" untuk memisahkan.</span>
        </div>
      </div>
      <button type="button" id="add-education-btn" class="add-item-btn">Tambah Pendidikan Formal</button>
      <h3>Pendidikan Non Formal</h3>
      <div id="non-formal-education-inputs">
        <div class="form-group non-formal-education-item-input">
          <input type="text" placeholder="Contoh: Kursus Bahasa Inggris, British Council (2010)" value="" />
          <span class="helper-text">Contoh: Nama Kursus, Penyelenggara (Tahun).</span>
        </div>
      </div>
      <button type="button" id="add-non-formal-education-btn" class="add-item-btn">Tambah Pendidikan Non Formal</button>
      <h3>Riwayat Pekerjaan</h3>
      <div id="work-experience-inputs">
        <div class="form-group work-experience-item-input">
          <textarea placeholder="Contoh: Dosen | Universitas Indonesia Timur | (Juni 2020 - Sekarang)"></textarea>
          <span class="helper-text">Format: Posisi | Nama Perusahaan | (Bulan Tahun Mulai - Bulan Tahun Selesai/Sekarang). Gunakan Enter untuk pekerjaan berikutnya.</span>
        </div>
      </div>
      <button type="button" id="add-work-experience-btn" class="add-item-btn">Tambah Pekerjaan</button>
      <h3>Pengalaman</h3>
      <div id="experience-inputs">
        <div class="form-group experience-year-input">
          <label>Tahun:</label>
          <input type="text" placeholder="Contoh: 2014" value="" />
          <label>Deskripsi (pisahkan dengan baris baru):</label>
          <textarea placeholder="Contoh:
- Pembangunan Aplikasi Keuangan dan Aset Desa Ver. 01
- Sistem Informasi Perjalanan Dinas (E-SPPD) Setwan Prov. Sulawesi Barat"></textarea>
          <span class="helper-text">Masukkan tahun pengalaman, lalu deskripsi di bawahnya. Gunakan Enter untuk setiap poin baru.</span>
        </div>
      </div>
      <button type="button" id="add-experience-btn" class="add-item-btn">Tambah Pengalaman</button>
      <br /><br />
      <button type="button" id="download-pdf-button" style="background-color: green; margin-top: 1rem">
        Simpan ke PDF
      </button>
    </div>
    <div id="cv-template">
      <div class="cv-header">
        <div>
          <h1 class="cv-title">
            CV. <span id="cv-title-first">TANNIEWA</span>
            <span class="last" id="cv-title-last">PUTRA</span>
          </h1>
          <div class="job-title" id="cv-job-title"></div>
        </div>
        <img id="company-logo" src="{{ asset('assets/images/logo3.png') }}" alt="Company Logo" />
      </div>
      <div class="profile">
        <div class="profile-photo-wrapper">
            @php
    $userPhoto = auth()->user()?->photo // ganti 'photo' sesuai nama kolom foto profil user Anda
        ? asset('storage/' . auth()->user()->photo)
        : asset('assets/images/avatardefault.webp');
@endphp
          <img id="profile-photo" src="{{ $userPhoto }}" alt="Foto Profil" />
        </div>
        <div class="profile-info">
          <p>
            <strong id="cv-full-name"></strong>
          </p>
          <p id="cv-birth-info"></p>
          <ul class="contact">
            <li>
              <i class="fas fa-envelope"></i>
              <span id="cv-email"></span>
            </li>
            <li>
              <i class="fas fa-phone"></i>
              <span id="cv-phone"></span>
            </li>
            <li>
              <i class="fas fa-map-marker-alt"></i>
              <span id="cv-address"></span>
            </li>
          </ul>
        </div>
      </div>
      <h2 class="section-title" id="formal-edu-title">PENDIDIKAN FORMAL</h2>
      <ul class="bullets" id="cv-education-list"></ul>
      <h2 class="section-title" id="non-formal-edu-title">PENDIDIKAN NON FORMAL</h2>
      <ul class="bullets" id="cv-non-formal-education-list"></ul>
      <h2 class="section-title">RIWAYAT PEKERJAAN</h2>
      <ul class="bullets" id="cv-work-experience-list"></ul>
      <h2 class="section-title">PENGALAMAN</h2>
      <div id="cv-experience-list"></div>
    </div>
    <script src="{{ asset('assets/js/scriptcv.js') }}"></script>
  </body>
</html>
