document.addEventListener("DOMContentLoaded", function () {
  // Foto upload
  const inputPhoto = document.getElementById("input-photo");
const profilePhoto = document.getElementById("profile-photo");
if (inputPhoto && profilePhoto) {
    inputPhoto.addEventListener("change", function (e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith("image/")) {
            const reader = new FileReader();
            reader.onload = function (evt) {
                profilePhoto.src = evt.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}

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

  // --- Dynamic Lists Elements ---
  const educationInputsContainer = document.getElementById("education-inputs");
  const addEducationBtn = document.getElementById("add-education-btn");
  const cvEducationList = document.getElementById("cv-education-list");
  const formalEduTitle = document.getElementById("formal-edu-title");

  // --- Non-Formal Education Elements ---
  const nonFormalEducationInputsContainer = document.getElementById("non-formal-education-inputs");
  const addNonFormalEducationBtn = document.getElementById("add-non-formal-education-btn");
  const cvNonFormalEducationList = document.getElementById("cv-non-formal-education-list");
  const nonFormalEduTitle = document.getElementById("non-formal-edu-title");

  const workExperienceInputsContainer = document.getElementById("work-experience-inputs");
  const addWorkExperienceBtn = document.getElementById("add-work-experience-btn");
  const cvWorkExperienceList = document.getElementById("cv-work-experience-list");
  const workExpTitle = document.querySelector('.section-title:nth-of-type(3)');

  const experienceInputsContainer = document.getElementById("experience-inputs");
  const addExperienceBtn = document.getElementById("add-experience-btn");
  const cvExperienceList = document.getElementById("cv-experience-list");
  const experienceTitle = document.querySelector('.section-title:nth-of-type(4)');

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
    cvFullName.parentElement.style.display = inputFullName.value.trim() === '' ? 'none' : 'block';
    cvBirthInfo.style.display = inputBirthInfo.value.trim() === '' ? 'none' : 'block';
    cvEmail.parentElement.style.display = inputEmail.value.trim() === '' ? 'none' : 'flex';
    cvPhone.parentElement.style.display = inputPhone.value.trim() === '' ? 'none' : 'flex';
    cvAddress.parentElement.style.display = inputAddress.value.trim() === '' ? 'none' : 'flex';

    const contactItems = cvEmail.parentElement.style.display === 'none' &&
                         cvPhone.parentElement.style.display === 'none' &&
                         cvAddress.parentElement.style.display === 'none';

    if (inputFullName.value.trim() === '' && inputBirthInfo.value.trim() === '' && contactItems) {
      cvFullName.parentElement.parentElement.style.borderLeft = 'none';
      cvFullName.parentElement.parentElement.style.paddingLeft = '0';
    } else {
      cvFullName.parentElement.parentElement.style.borderLeft = '5px solid var(--primary)';
      cvFullName.parentElement.parentElement.style.paddingLeft = '1.2rem';
    }
  }

  // --- Education List Dynamic Update (with hide/show logic) ---
  function updateEducationList() {
    cvEducationList.innerHTML = "";
    const educationInputs = educationInputsContainer.querySelectorAll(".education-item-input input");
    let hasContent = false;
    educationInputs.forEach((input) => {
      if (input.value.trim() !== "") {
        const listItem = document.createElement("li");
        const parts = input.value.split(" - ");
        if (parts.length === 2) {
          listItem.innerHTML = `<strong>${parts[1].trim()}</strong><br>${parts[0].trim()}`;
        } else {
          listItem.textContent = input.value.trim();
        }
        cvEducationList.appendChild(listItem);
        hasContent = true;
      }
    });
    if (hasContent) {
      formalEduTitle.style.display = "flex";
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
    updateEducationList();
  });

  // --- Non-Formal Education List Dynamic Update (with hide/show logic) ---
  function updateNonFormalEducationList() {
    cvNonFormalEducationList.innerHTML = "";
    const nonFormalEducationInputs = nonFormalEducationInputsContainer.querySelectorAll(".non-formal-education-item-input input");
    let hasContent = false;
    nonFormalEducationInputs.forEach((input) => {
      if (input.value.trim() !== "") {
        const listItem = document.createElement("li");
        listItem.textContent = input.value.trim();
        cvNonFormalEducationList.appendChild(listItem);
        hasContent = true;
      }
    });
    if (hasContent) {
      nonFormalEduTitle.style.display = "flex";
      cvNonFormalEducationList.style.display = "block";
    } else {
      nonFormalEduTitle.style.display = "none";
      cvNonFormalEducationList.style.display = "none";
    }
  }
  addNonFormalEducationBtn.addEventListener("click", function () {
    const newNonFormalEducationDiv = document.createElement("div");
    newNonFormalEducationDiv.className = "form-group non-formal-education-item-input";
    newNonFormalEducationDiv.innerHTML = `
      <input type="text" placeholder="Contoh: Kursus Bahasa Inggris, British Council (2010)" value="">
      <span class="helper-text">Contoh: Nama Kursus, Penyelenggara (Tahun).</span>
    `;
    nonFormalEducationInputsContainer.appendChild(newNonFormalEducationDiv);
    updateNonFormalEducationList();
  });

  // --- Work Experience List Dynamic Update (with hide/show logic) ---
  function updateWorkExperienceList() {
    cvWorkExperienceList.innerHTML = "";
    const workExperienceItems = workExperienceInputsContainer.querySelectorAll(".work-experience-item-input textarea");
    let hasContent = false;
    workExperienceItems.forEach((textarea) => {
      const lines = textarea.value.split("\n").filter((line) => line.trim() !== "");
      lines.forEach((line) => {
        if (line.trim() !== "") {
          const listItem = document.createElement("li");
          const parts = line.split("|");
          if (parts.length > 1) {
            listItem.innerHTML = `<strong>${parts[0].trim()}</strong><br>${parts.slice(1).join("|").trim()}`;
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
    updateWorkExperienceList();
  });

  // --- Experience List Dynamic Update (with hide/show logic) ---
  function updateExperienceList() {
    cvExperienceList.innerHTML = "";
    const experienceYearInputs = experienceInputsContainer.querySelectorAll(".experience-year-input");
    let hasContent = false;
    experienceYearInputs.forEach((yearDiv) => {
      const yearInput = yearDiv.querySelector('input[type="text"]');
      const descriptionTextarea = yearDiv.querySelector("textarea");
      const year = yearInput ? yearInput.value.trim() : "";
      const descriptions = descriptionTextarea ? descriptionTextarea.value.split("\n").filter((line) => line.trim() !== "") : [];
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
- Proyek B"></textarea>
      <span class="helper-text">Masukkan tahun pengalaman, lalu deskripsi di bawahnya. Gunakan Enter untuk setiap poin baru.</span>
    `;
    experienceInputsContainer.appendChild(newExperienceDiv);
    updateExperienceList();
  });

  // Initialize all fields to be empty and update CV to reflect that
  function initializeEmptyInputsAndCV() {
    inputJobTitle.value = "";
    inputFullName.value = "";
    inputBirthInfo.value = "";
    inputEmail.value = "";
    inputPhone.value = "";
    inputAddress.value = "";
    educationInputsContainer.innerHTML = '';
    addEducationBtn.click();
    educationInputsContainer.querySelector('input').value = '';
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
    updateStaticFields();
    updateEducationList();
    updateNonFormalEducationList();
    updateWorkExperienceList();
    updateExperienceList();
  }
  // Call the initialization function when the page loads
  initializeEmptyInputsAndCV();

  // Real-time updates for static fields
  inputJobTitle.addEventListener("input", updateStaticFields);
  inputFullName.addEventListener("input", updateStaticFields);
  inputBirthInfo.addEventListener("input", updateStaticFields);
  inputEmail.addEventListener("input", updateStaticFields);
  inputPhone.addEventListener("input", updateStaticFields);
  inputAddress.addEventListener("input", updateStaticFields);

  // Real-time updates for dynamic sections
  educationInputsContainer.addEventListener("input", updateEducationList);
  nonFormalEducationInputsContainer.addEventListener("input", updateNonFormalEducationList);
  workExperienceInputsContainer.addEventListener("input", updateWorkExperienceList);
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
