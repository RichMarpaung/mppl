<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CV TANNIEWA PUTRA (Dinamis)</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

    <style>
      :root {
        --primary: #a00000; /* Darker red */
        --accent: #f0f0f0; /* Lighter gray for background */
        --text-dark: #333;
        --text-light: #555;
        --input-bg: #f9f9f9;
        --input-border: #ddd;
        --helper-text: #777; /* Color for helper text */
      }

      body {
        font-family: "Helvetica Neue", Arial, sans-serif;
        margin: 0;
        background: var(--accent);
        display: flex; /* Use flexbox for side-by-side layout */
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
        padding: 2rem; /* Add some padding around the whole layout */
        box-sizing: border-box;
      }

      /* Input Panel Styling */
      #input-panel {
        width: 350px; /* Adjust width as needed */
        background: #fff;
        padding: 2rem;
        margin-right: 2rem; /* Space between input panel and CV */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        position: sticky; /* Makes it stay on screen when scrolling CV */
        top: 2rem; /* Aligns with CV's top margin */
        max-height: calc(
          100vh - 4rem
        ); /* Ensure it doesn't overflow viewport */
        overflow-y: auto; /* Allow scrolling if content is too long */
      }

      #input-panel h2 {
        color: var(--primary);
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--accent);
        padding-bottom: 10px;
      }

      #input-panel h3 {
        /* Style for sub-headings like Pendidikan Formal */
        color: var(--primary);
        font-size: 1.2rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
        border-bottom: 1px dashed var(--input-border);
        padding-bottom: 5px;
      }

      .form-group {
        margin-bottom: 1rem;
      }

      .form-group label {
        display: block;
        margin-bottom: 0.4rem;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.95rem;
      }

      .form-group input[type="text"],
      .form-group textarea {
        width: calc(100% - 20px); /* Account for padding */
        padding: 10px;
        border: 1px solid var(--input-border);
        border-radius: 4px;
        font-size: 0.9rem;
        background-color: var(--input-bg);
        color: var(--text-dark);
      }

      .form-group textarea {
        resize: vertical;
        min-height: 60px;
      }

      .form-group button {
        background-color: var(--primary);
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease;
        margin-top: 0.5rem; /* Space button from input field */
      }

      .form-group button:hover {
        background-color: #7a0000;
      }

      /* Specific button style for add buttons */
      .add-item-btn {
        background-color: #555; /* A more neutral color for add buttons */
        margin-bottom: 1.5rem; /* Space between add button and next section */
      }

      .add-item-btn:hover {
        background-color: #333;
      }

      /* Helper text styling */
      .helper-text {
        font-size: 0.8rem;
        color: var(--helper-text);
        margin-top: 0.2rem;
        margin-bottom: 0.5rem;
        display: block; /* Ensure it takes its own line */
      }

      /* CV Template Styling (mostly from previous version) */
      #cv-template {
        width: 794px; /* A4 width at 96 DPI */
        background: #fff;
        position: relative;
        padding: 2.5rem 3rem;
        box-sizing: border-box;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        /*gap: 1.5rem;*/
        overflow: hidden; /* CRITICAL: Clips the diamond shape */
      }

      /* Red decorative diamond shape on the right */
      #cv-template::before {
        content: "";
        position: absolute;
        top: 37%; /* Approximately where it starts in the image */
        right: -200px; /* Adjust this value to control how much of the diamond is visible. */
        width: 300px; /* Size of the diamond */
        height: 300px; /* Size of the diamond */
        background: var(--primary);
        transform: rotate(45deg); /* Creates the diamond shape */
        border-radius: 50px; /* Slightly rounded corners for the diamond */
        z-index: 0; /* Behind content */
      }

      /* =========== HEADER =========== */
      .cv-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        position: relative;
        z-index: 2; /* Ensure header is above the diamond */
      }

      #company-logo {
        width: 80px;
        height: auto;
        object-fit: contain;
      }

      /* Judul CV */
      .cv-title {
        position: relative;
        font-size: 2.2rem;
        font-weight: 700;
        line-height: 1.1;
        letter-spacing: 0.5px;
        color: var(--text-dark);
        margin: 0;
        padding-left: 25px;
      }

      .cv-title::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 15px;
        height: 100%;
        background: var(--primary);
        border-radius: 4px;
      }

      .cv-title span.last {
        display: block;
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1.2;
      }

      .job-title {
        margin: 0.4rem 0 1.6rem;
        font-size: 0.9rem;
        color: var(--text-light);
        letter-spacing: 0.4px;
        padding-left: 25px;
      }

      /* ========= PROFIL ========== */
      .profile {
        display: grid;
        grid-template-columns: 150px 1fr;
        column-gap: 1.8rem;
        align-items: flex-start;
        z-index: 2; /* Ensure profile is above the diamond */
      }

      .profile img {
        width: 150px;
        height: 180px;
        object-fit: cover;
        border: 3px solid var(--accent);
        border-radius: 8px;
      }

      .profile-info {
        border-left: 5px solid var(--primary);
        padding-left: 1.2rem;
        line-height: 1.5;
        font-size: 0.95rem;
        color: var(--text-dark);
      }

      .profile-info p {
        margin: 0.3rem 0;
      }

      .contact {
        list-style: none;
        padding: 0;
        margin-top: 1rem;
      }

      .contact li {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        margin: 0.5rem 0;
        color: var(--text-light);
      }

      .contact i {
        width: 25px;
        color: var(--primary);
        text-align: center;
        font-size: 1.1em;
      }

      /* ========= SECTION TITLE ========== */
      .section-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 1.2rem 0 0.5rem; /* Reduced from 1.6rem 0 .8rem */
        display: flex;
        align-items: center;
        letter-spacing: 0.6px;
        color: var(--text-dark);
        text-transform: uppercase;
        position: relative;
        padding-left: 20px;
        z-index: 2; /* Ensure section titles are above the diamond */
      }

      .section-title::before {
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        display: inline-block;
        width: 10px;
        height: 10px;
        background: var(--primary);
        border-radius: 2px;
        margin-right: 8px;
      }

      /* The red line after the title */
      .section-title::after {
        content: "";
        flex-grow: 1;
        height: 2px;
        background: var(--primary);
        margin-left: 15px;
      }

      ul.bullets {
        padding-left: 1.2rem;
        margin: 0.1rem 0 0.8rem; /* Reduced from .3rem 0 */
        color: var(--text-light);
        z-index: 2; /* Ensure bullet lists are above the diamond */
        position: relative; /* To make z-index effective */
      }

      ul.bullets li {
        margin: 0.4rem 0;
        font-size: 0.92rem;
        line-height: 1.4;
      }

      /* Specific styling for the 'Pengalaman' section year headers */
      .experience-item {
        margin-bottom: 1rem;
        z-index: 2; /* Ensure experience items are above the diamond */
        position: relative; /* To make z-index effective */
      }

      .experience-item h3 {
        color: var(--primary);
        font-size: 1.05rem;
        margin-bottom: 0.5rem;
      }

      /* Print styles */
      @media print {
        body {
          background: #fff;
          -webkit-print-color-adjust: exact;
          print-color-adjust: exact;
          display: block; /* Remove flex for print */
          padding: 0;
        }
        #input-panel {
          display: none; /* Hide input panel when printing */
        }
        #cv-template {
          margin: 0 auto;
          width: 794px; /* Ensure A4 width is maintained for print */
          box-shadow: none;
          padding: 0; /* Remove padding for print to maximize content area */
          page-break-after: always;
          overflow: visible; /* Ensure content is not clipped when printing */
        }
        #cv-template::before,
        #cv-template::after {
          display: none; /* Hide decorative elements for print */
        }

        .cv-header,
        .profile,
        .section-title,
        ul.bullets,
        .experience-item {
          margin: 1rem 0;
          padding: 0 1.5rem; /* Re-add some horizontal padding for content */
        }

        .cv-title,
        .job-title {
          padding-left: 1.5rem;
        }
      }
    </style>
  </head>
  <body>
    

    <div id="input-panel">
      <h2>Input Data CV</h2>

      <div class="form-group">
        <label for="input-job-title">Jabatan:</label>
        <input
          type="text"
          id="input-job-title"
          placeholder="Contoh: DIREKTUR | SENIOR SISTEM ANALYST"
          value=""
        />
        <span class="helper-text"
          >Masukkan jabatan Anda saat ini atau yang terakhir.</span
        >
      </div>
      <div class="form-group">
        <label for="input-full-name">Nama Lengkap & Gelar:</label>
        <input
          type="text"
          id="input-full-name"
          placeholder="Contoh: Dr. Ir. Adam M Tanniewa, S.Kom., S.E., M.M., M.T."
          value=""
        />
        <span class="helper-text"
          >Isi nama lengkap Anda beserta gelar akademik jika ada.</span
        >
      </div>
      <div class="form-group">
        <label for="input-birth-info">Tempat, Tanggal Lahir:</label>
        <input
          type="text"
          id="input-birth-info"
          placeholder="Contoh: Polewali, 31 Desember 1976"
          value=""
        />
        <span class="helper-text"
          >Format: Kota, DD Bulan YYYY (contoh: Jakarta, 01 Januari 1990).</span
        >
      </div>
      <div class="form-group">
        <label for="input-email">Email:</label>
        <input
          type="text"
          id="input-email"
          placeholder="Contoh: nama.anda@email.com"
          value=""
        />
        <span class="helper-text">Masukkan alamat email aktif Anda.</span>
      </div>
      <div class="form-group">
        <label for="input-phone">Telepon:</label>
        <input
          type="text"
          id="input-phone"
          placeholder="Contoh: +62-8123-4567-890"
          value=""
        />
        <span class="helper-text">Masukkan nomor telepon Anda.</span>
      </div>
      <div class="form-group">
        <label for="input-address">Alamat:</label>
        <input
          type="text"
          id="input-address"
          placeholder="Contoh: Manding, Polewali, Polewali Mandar"
          value=""
        />
        <span class="helper-text"
          >Isi alamat domisili Anda saat ini (opsional detail).</span
        >
      </div>

      <h3>Pendidikan Formal</h3>
      <div id="education-inputs">
        <div class="form-group education-item-input">
          <input
            type="text"
            placeholder="Contoh: Universitas Muslim Indonesia - S3"
            value=""
          />
          <span class="helper-text"
            >Format: Nama Institusi - Tingkat (contoh: Universitas ABC - S1).
            Gunakan "-" untuk memisahkan.</span
          >
        </div>
      </div>
      <button type="button" id="add-education-btn" class="add-item-btn">
        Tambah Pendidikan Formal
      </button>

      <h3>Pendidikan Non Formal</h3>
      <div id="non-formal-education-inputs">
        <div class="form-group non-formal-education-item-input">
          <input
            type="text"
            placeholder="Contoh: Kursus Bahasa Inggris, British Council (2010)"
            value=""
          />
          <span class="helper-text"
            >Contoh: Nama Kursus, Penyelenggara (Tahun).</span
          >
        </div>
      </div>
      <button
        type="button"
        id="add-non-formal-education-btn"
        class="add-item-btn"
      >
        Tambah Pendidikan Non Formal
      </button>

      <h3>Riwayat Pekerjaan</h3>
      <div id="work-experience-inputs">
        <div class="form-group work-experience-item-input">
          <textarea placeholder="Contoh: Dosen | Universitas Indonesia Timur | (Juni 2020 - Sekarang)">
</textarea
          >
          <span class="helper-text"
            >Format: Posisi | Nama Perusahaan | (Bulan Tahun Mulai - Bulan
            Tahun Selesai/Sekarang). Gunakan Enter untuk pekerjaan
            berikutnya.</span
          >
        </div>
      </div>
      <button type="button" id="add-work-experience-btn" class="add-item-btn">
        Tambah Pekerjaan
      </button>

      <h3>Pengalaman</h3>
      <div id="experience-inputs">
        <div class="form-group experience-year-input">
          <label>Tahun:</label>
          <input type="text" placeholder="Contoh: 2014" value="" />
          <label>Deskripsi (pisahkan dengan baris baru):</label>
          <textarea
            placeholder="Contoh:
- Pembangunan Aplikasi Keuangan dan Aset Desa Ver. 01
- Sistem Informasi Perjalanan Dinas (E-SPPD) Setwan Prov. Sulawesi Barat"
          >
</textarea
          >
          <span class="helper-text"
            >Masukkan tahun pengalaman, lalu deskripsi di bawahnya. Gunakan
            Enter untuk setiap poin baru.</span
          >
        </div>
      </div>
      <button type="button" id="add-experience-btn" class="add-item-btn">
        Tambah Pengalaman
      </button>

      <br /><br />
      <button
      type="button"
      id="download-pdf-button"
      style="background-color: green; margin-top: 1rem"
    >
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
        <img id="company-logo" src="logo3.png" alt="Company Logo" />
      </div>

      <div class="profile">
        <img id="profile-photo" src="profile.png" alt="Foto Profil" />
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

      <h2 class="section-title" id="non-formal-edu-title">
        PENDIDIKAN NON FORMAL
      </h2>
      <ul class="bullets" id="cv-non-formal-education-list"></ul>

      <h2 class="section-title">RIWAYAT PEKERJAAN</h2>
      <ul class="bullets" id="cv-work-experience-list"></ul>

      <h2 class="section-title">PENGALAMAN</h2>
      <div id="cv-experience-list"></div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // --- Get references to input fields ---
        const inputJobTitle = document.getElementById("input-job-title");
        const inputFullName = document.getElementById("input-full-name");
        const inputBirthInfo = document.getElementById("input-birth-info");
        const inputEmail = document.getElementById("input-email");
        const inputPhone = document.getElementById("input-phone");
        const inputAddress = document.getElementById("input-address");

        // --- Get references to CV display elements ---
        const cvTitleFirst = document.getElementById("cv-title-first");
        const cvTitleLast = document.getElementById("cv-title-last");
        const cvJobTitle = document.getElementById("cv-job-title");
        const cvFullName = document.getElementById("cv-full-name");
        const cvBirthInfo = document.getElementById("cv-birth-info");
        const cvEmail = document.getElementById("cv-email");
        const cvPhone = document.getElementById("cv-phone");
        const cvAddress = document.getElementById("cv-address");

        const updateCvButton = document.getElementById("update-cv-button");

        // --- Dynamic Lists Elements ---
        const educationInputsContainer =
          document.getElementById("education-inputs");
        const addEducationBtn = document.getElementById("add-education-btn");
        const cvEducationList = document.getElementById("cv-education-list");
        const formalEduTitle = document.getElementById("formal-edu-title"); // Reference to the Formal H2 title

        // --- Non-Formal Education Elements ---
        const nonFormalEducationInputsContainer = document.getElementById(
          "non-formal-education-inputs"
        );
        const addNonFormalEducationBtn = document.getElementById(
          "add-non-formal-education-btn"
        );
        const cvNonFormalEducationList = document.getElementById(
          "cv-non-formal-education-list"
        );
        const nonFormalEduTitle = document.getElementById(
          "non-formal-edu-title"
        );

        const workExperienceInputsContainer = document.getElementById(
          "work-experience-inputs"
        );
        const addWorkExperienceBtn = document.getElementById(
          "add-work-experience-btn"
        );
        const cvWorkExperienceList = document.getElementById(
          "cv-work-experience-list"
        );
        const workExpTitle = document.querySelector(
          '.section-title:nth-of-type(3)'
        ); // Assuming "RIWAYAT PEKERJAAN" is the 3rd .section-title

        const experienceInputsContainer =
          document.getElementById("experience-inputs");
        const addExperienceBtn = document.getElementById("add-experience-btn");
        const cvExperienceList = document.getElementById("cv-experience-list");
        const experienceTitle = document.querySelector(
          '.section-title:nth-of-type(4)'
        ); // Assuming "PENGALAMAN" is the 4th .section-title

        // Function to update static text fields
        function updateStaticFields() {
          cvJobTitle.textContent = inputJobTitle.value;
          cvFullName.textContent = inputFullName.value;
          cvBirthInfo.textContent = inputBirthInfo.value;
          cvEmail.textContent = inputEmail.value;
          cvPhone.textContent = inputPhone.value;
          cvAddress.textContent = inputAddress.value;

          // Hide CV elements if their corresponding input is empty
          cvJobTitle.style.display = inputJobTitle.value.trim() === '' ? 'none' : 'block';
          cvFullName.parentElement.style.display = inputFullName.value.trim() === '' ? 'none' : 'block'; // Hide entire <p> for full name
          cvBirthInfo.style.display = inputBirthInfo.value.trim() === '' ? 'none' : 'block';
          
          // For contact list items, hide the entire <li> if either email, phone, or address is empty
          cvEmail.parentElement.style.display = inputEmail.value.trim() === '' ? 'none' : 'flex';
          cvPhone.parentElement.style.display = inputPhone.value.trim() === '' ? 'none' : 'flex';
          cvAddress.parentElement.style.display = inputAddress.value.trim() === '' ? 'none' : 'flex';

          // If all profile contact details are empty, hide the entire profile-info border
          const contactItems = cvEmail.parentElement.style.display === 'none' &&
                               cvPhone.parentElement.style.display === 'none' &&
                               cvAddress.parentElement.style.display === 'none';
          
          if (inputFullName.value.trim() === '' && inputBirthInfo.value.trim() === '' && contactItems) {
            cvFullName.parentElement.parentElement.style.borderLeft = 'none'; // Remove border if all contact info is hidden
            cvFullName.parentElement.parentElement.style.paddingLeft = '0';
          } else {
            cvFullName.parentElement.parentElement.style.borderLeft = '5px solid var(--primary)';
            cvFullName.parentElement.parentElement.style.paddingLeft = '1.2rem';
          }
        }

        // --- Education List Dynamic Update (with hide/show logic) ---
        function updateEducationList() {
          cvEducationList.innerHTML = ""; // Clear current list
          const educationInputs = educationInputsContainer.querySelectorAll(
            ".education-item-input input"
          );
          let hasContent = false; // Flag to check if any input has content

          educationInputs.forEach((input) => {
            if (input.value.trim() !== "") {
              // Only add if the input has content
              const listItem = document.createElement("li");
              // Check if the input value contains a hyphen to format it with <strong> for S3/S2/S1
              const parts = input.value.split(" - ");
              if (parts.length === 2) {
                listItem.innerHTML = `<strong>${parts[1].trim()}</strong><br>${parts[0].trim()}`;
              } else {
                listItem.textContent = input.value.trim();
              }
              cvEducationList.appendChild(listItem);
              hasContent = true; // Set flag to true if content is found
            }
          });

          // Show or hide the section based on content
          if (hasContent) {
            formalEduTitle.style.display = "flex"; // Use 'flex' because .section-title is flex
            cvEducationList.style.display = "block";
          } else {
            formalEduTitle.style.display = "none";
            cvEducationList.style.display = "none";
          }
        }

        addEducationBtn.addEventListener("click", function () {
          const newEducationDiv = document.createElement("div");
          newEducationDiv.className = "form-group education-item-input";
          newEducationDiv.innerHTML = `
            <input type="text" placeholder="Contoh: Universitas Muslim Indonesia - S3" value="">
            <span class="helper-text">Format: Nama Institusi - Tingkat (contoh: Universitas ABC - S1). Gunakan "-" untuk memisahkan.</span>
          `;
          educationInputsContainer.appendChild(newEducationDiv);
          // Immediately update to show the section if a new input is added and filled
          updateEducationList();
        });

        // --- Non-Formal Education List Dynamic Update (with hide/show logic) ---
        function updateNonFormalEducationList() {
          cvNonFormalEducationList.innerHTML = ""; // Clear current list
          const nonFormalEducationInputs =
            nonFormalEducationInputsContainer.querySelectorAll(
              ".non-formal-education-item-input input"
            );
          let hasContent = false; // Flag to check if any input has content

          nonFormalEducationInputs.forEach((input) => {
            if (input.value.trim() !== "") {
              const listItem = document.createElement("li");
              listItem.textContent = input.value.trim();
              cvNonFormalEducationList.appendChild(listItem);
              hasContent = true; // Set flag to true if content is found
            }
          });

          // Show or hide the section based on content
          if (hasContent) {
            nonFormalEduTitle.style.display = "flex"; // Use 'flex' because .section-title is flex
            cvNonFormalEducationList.style.display = "block";
          } else {
            nonFormalEduTitle.style.display = "none";
            cvNonFormalEducationList.style.display = "none";
          }
        }

        addNonFormalEducationBtn.addEventListener("click", function () {
          const newNonFormalEducationDiv = document.createElement("div");
          newNonFormalEducationDiv.className =
            "form-group non-formal-education-item-input";
          newNonFormalEducationDiv.innerHTML = `
            <input type="text" placeholder="Contoh: Kursus Bahasa Inggris, British Council (2010)" value="">
            <span class="helper-text">Contoh: Nama Kursus, Penyelenggara (Tahun).</span>
          `;
          nonFormalEducationInputsContainer.appendChild(
            newNonFormalEducationDiv
          );
          updateNonFormalEducationList();
        });

        // --- Work Experience List Dynamic Update (with hide/show logic) ---
        function updateWorkExperienceList() {
          cvWorkExperienceList.innerHTML = ""; // Clear current list
          const workExperienceItems =
            workExperienceInputsContainer.querySelectorAll(
              ".work-experience-item-input textarea"
            );
          let hasContent = false;

          workExperienceItems.forEach((textarea) => {
            const lines = textarea.value
              .split("\n")
              .filter((line) => line.trim() !== ""); // Filter out empty lines
            lines.forEach((line) => {
              if (line.trim() !== "") {
                const listItem = document.createElement("li");
                const parts = line.split("|");
                if (parts.length > 1) {
                  listItem.innerHTML = `<strong>${parts[0].trim()}</strong><br>${parts
                    .slice(1)
                    .join("|")
                    .trim()}`;
                } else {
                  listItem.textContent = line.trim();
                }
                cvWorkExperienceList.appendChild(listItem);
                hasContent = true;
              }
            });
          });

          if (hasContent) {
            workExpTitle.style.display = "flex";
            cvWorkExperienceList.style.display = "block";
          } else {
            workExpTitle.style.display = "none";
            cvWorkExperienceList.style.display = "none";
          }
        }

        addWorkExperienceBtn.addEventListener("click", function () {
          const newWorkExpDiv = document.createElement("div");
          newWorkExpDiv.className = "form-group work-experience-item-input";
          newWorkExpDiv.innerHTML = `
            <textarea placeholder="Contoh: Posisi | Nama Perusahaan | (Bulan Tahun Mulai - Bulan Tahun Selesai/Sekarang)"></textarea>
            <span class="helper-text">Format: Posisi | Nama Perusahaan | (Bulan Tahun Mulai - Bulan Tahun Selesai/Sekarang). Gunakan Enter untuk pekerjaan berikutnya.</span>
          `;
          workExperienceInputsContainer.appendChild(newWorkExpDiv);
          updateWorkExperienceList(); // Update after adding new input
        });

        // --- Experience List Dynamic Update (with hide/show logic) ---
        function updateExperienceList() {
          cvExperienceList.innerHTML = ""; // Clear current list
          const experienceYearInputs =
            experienceInputsContainer.querySelectorAll(
              ".experience-year-input"
            );
          let hasContent = false;

          experienceYearInputs.forEach((yearDiv) => {
            const yearInput = yearDiv.querySelector('input[type="text"]');
            const descriptionTextarea = yearDiv.querySelector("textarea");
            const year = yearInput ? yearInput.value.trim() : "";
            const descriptions = descriptionTextarea
              ? descriptionTextarea.value
                  .split("\n")
                  .filter((line) => line.trim() !== "")
              : [];

            if (year !== "" || descriptions.length > 0) {
              const experienceItemDiv = document.createElement("div");
              experienceItemDiv.className = "experience-item";

              if (year !== "") {
                const h3 = document.createElement("h3");
                h3.className = "experience-year";
                h3.textContent = year;
                experienceItemDiv.appendChild(h3);
              }

              if (descriptions.length > 0) {
                const ul = document.createElement("ul");
                ul.className = "bullets experience-description-list";
                descriptions.forEach((desc) => {
                  const li = document.createElement("li");
                  li.textContent = desc.trim();
                  ul.appendChild(li);
                });
                experienceItemDiv.appendChild(ul);
              }
              cvExperienceList.appendChild(experienceItemDiv);
              hasContent = true;
            }
          });

          if (hasContent) {
            experienceTitle.style.display = "flex";
            cvExperienceList.style.display = "block";
          } else {
            experienceTitle.style.display = "none";
            cvExperienceList.style.display = "none";
          }
        }

        addExperienceBtn.addEventListener("click", function () {
          const newExperienceDiv = document.createElement("div");
          newExperienceDiv.className = "form-group experience-year-input";
          newExperienceDiv.innerHTML = `
            <label>Tahun:</label>
            <input type="text" placeholder="Contoh: 2020" value="">
            <label>Deskripsi (pisahkan dengan baris baru):</label>
            <textarea placeholder="Contoh:
- Proyek A
- Proyek B">
</textarea>
            <span class="helper-text">Masukkan tahun pengalaman, lalu deskripsi di bawahnya. Gunakan Enter untuk setiap poin baru.</span>
          `;
          experienceInputsContainer.appendChild(newExperienceDiv);
          updateExperienceList(); // Update after adding new input
        });

        // Initialize all fields to be empty and update CV to reflect that
        function initializeEmptyInputsAndCV() {
            // Clear static input fields
            inputJobTitle.value = "";
            inputFullName.value = "";
            inputBirthInfo.value = "";
            inputEmail.value = "";
            inputPhone.value = "";
            inputAddress.value = "";

            // Clear dynamic input containers, add one empty default item
            educationInputsContainer.innerHTML = '';
            addEducationBtn.click(); // Add one default empty input
            educationInputsContainer.querySelector('input').value = ''; // Ensure it's empty

            nonFormalEducationInputsContainer.innerHTML = '';
            addNonFormalEducationBtn.click();
            nonFormalEducationInputsContainer.querySelector('input').value = '';

            workExperienceInputsContainer.innerHTML = '';
            addWorkExperienceBtn.click();
            workExperienceInputsContainer.querySelector('textarea').value = '';

            experienceInputsContainer.innerHTML = '';
            addExperienceBtn.click();
            experienceInputsContainer.querySelector('input').value = '';
            experienceInputsContainer.querySelector('textarea').value = '';


            // Update CV to reflect empty state
            updateStaticFields();
            updateEducationList();
            updateNonFormalEducationList();
            updateWorkExperienceList();
            updateExperienceList();
        }

        // Call the initialization function when the page loads
        initializeEmptyInputsAndCV();

        // Add event listener to the main update button
        updateCvButton.addEventListener("click", function () {
          updateStaticFields();
          updateEducationList();
          updateNonFormalEducationList();
          updateWorkExperienceList();
          updateExperienceList();
        });

        // Real-time updates for static fields
        inputJobTitle.addEventListener("input", updateStaticFields);
        inputFullName.addEventListener("input", updateStaticFields);
        inputBirthInfo.addEventListener("input", updateStaticFields);
        inputEmail.addEventListener("input", updateStaticFields);
        inputPhone.addEventListener("input", updateStaticFields);
        inputAddress.addEventListener("input", updateStaticFields);

        // Real-time updates for dynamic sections
        educationInputsContainer.addEventListener("input", updateEducationList);
        nonFormalEducationInputsContainer.addEventListener(
          "input",
          updateNonFormalEducationList
        );
        workExperienceInputsContainer.addEventListener(
          "input",
          updateWorkExperienceList
        );
        experienceInputsContainer.addEventListener("input", updateExperienceList);

        const downloadPdfButton = document.getElementById("download-pdf-button");

        downloadPdfButton.addEventListener("click", function () {
          const element = document.getElementById("cv-template");

          const opt = {
            margin: 0,
            filename: "CV_Tanniewa_Putra.pdf",
            image: { type: "jpeg", quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: "pt", format: "a4", orientation: "portrait" },
          };

          html2pdf().set(opt).from(element).save();
        });
      });
    </script>
  </body>
</html>