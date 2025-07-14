{{-- filepath: c:\laragon\www\Mppl\resources\views\cv.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV TANNIEWA PUTRA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ...existing styles... */
        :root {
            --primary: #A00000;
            --accent: #F0F0F0;
            --text-dark: #333;
            --text-light: #555;
            --input-bg: #f9f9f9;
            --input-border: #ddd;
        }
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            background: var(--accent);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 2rem;
            box-sizing: border-box;
        }
        /* Navbar */
        .navbar-cv {
            width: 100vw;
            background: #A00000;
            color: #fff;
            padding: 0.7rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        .navbar-cv .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            font-size: 1.2rem;
            letter-spacing: 1px;
        }
        .navbar-cv img {
            height: 38px;
            width: auto;
        }
        .navbar-cv .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .navbar-cv .nav-links a, .navbar-cv .nav-links button {
            color: #fff;
            text-decoration: none;
            background: none;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            padding: 0.3rem 0.7rem;
            border-radius: 4px;
            transition: background 0.2s;
        }
        .navbar-cv .nav-links a:hover, .navbar-cv .nav-links button:hover {
            background: #7a0000;
        }
        .navbar-cv .nav-links .btn-pdf {
            background: #fff;
            color: #A00000;
            font-weight: bold;
            border: 1px solid #A00000;
            padding: 0.3rem 1rem;
            margin-left: 1rem;
        }
        .navbar-cv .nav-links .btn-pdf:hover {
            background: #A00000;
            color: #fff;
        }
        body { padding-top: 70px !important; }
        /* ...rest of your styles (input panel, cv-template, etc)... */
        /* Copy all your previous styles here */
        /* Input Panel Styling */
        #input-panel { width: 350px; background: #fff; padding: 2rem; margin-right: 2rem; box-shadow: 0 4px 12px rgba(0, 0, 0, .1); border-radius: 8px; position: sticky; top: 2rem; max-height: calc(100vh - 4rem); overflow-y: auto; }
        #input-panel h2 { color: var(--primary); font-size: 1.5rem; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 2px solid var(--accent); padding-bottom: 10px; }
        #input-panel h3 { color: var(--primary); font-size: 1.2rem; margin-top: 2rem; margin-bottom: 1rem; border-bottom: 1px dashed var(--input-border); padding-bottom: 5px; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.4rem; font-weight: 600; color: var(--text-dark); font-size: 0.95rem; }
        .form-group input[type="text"], .form-group textarea { width: calc(100% - 20px); padding: 10px; border: 1px solid var(--input-border); border-radius: 4px; font-size: 0.9rem; background-color: var(--input-bg); color: var(--text-dark); }
        .form-group textarea { resize: vertical; min-height: 60px; }
        .form-group button { background-color: var(--primary); color: #fff; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer; font-size: 1rem; transition: background-color 0.3s ease; margin-top: 0.5rem; }
        .form-group button:hover { background-color: #7a0000; }
        .add-item-btn { background-color: #555; margin-bottom: 1.5rem; }
        .add-item-btn:hover { background-color: #333; }
        #cv-template { width: 794px; background: #fff; position: relative; padding: 2.5rem 3rem; box-sizing: border-box; box-shadow: 0 4px 12px rgba(0, 0, 0, .1); display: flex; flex-direction: column; overflow: hidden; }
        #cv-template::before { content: ""; position: absolute; top: 37%; right: -200px; width: 300px; height: 300px; background: var(--primary); transform: rotate(45deg); border-radius: 50px; z-index: 0; }
        .cv-header { display: flex; justify-content: space-between; align-items: flex-start; position: relative; z-index: 2; }
        #company-logo { width: 80px; height: auto; object-fit: contain; }
        .cv-title { position: relative; font-size: 2.2rem; font-weight: 700; line-height: 1.1; letter-spacing: .5px; color: var(--text-dark); margin: 0; padding-left: 25px; }
        .cv-title::before { content: ""; position: absolute; left: 0; top: 0; width: 15px; height: 100%; background: var(--primary); border-radius: 4px; }
        .cv-title span.last { display: block; font-size: 1.8rem; font-weight: 800; color: var(--primary); line-height: 1.2; }
        .job-title { margin: .4rem 0 1.6rem; font-size: .9rem; color: var(--text-light); letter-spacing: .4px; padding-left: 25px; }
        .profile { display: grid; grid-template-columns: 150px 1fr; column-gap: 1.8rem; align-items: flex-start; z-index: 2; }
        .profile img { width: 150px; height: 180px; object-fit: cover; border: 3px solid var(--accent); border-radius: 8px; }
        .profile-info { border-left: 5px solid var(--primary); padding-left: 1.2rem; line-height: 1.5; font-size: .95rem; color: var(--text-dark); }
        .profile-info p { margin: .3rem 0; }
        .contact { list-style: none; padding: 0; margin-top: 1rem; }
        .contact li { display: flex; align-items: center; font-size: .9rem; margin: .5rem 0; color: var(--text-light); }
        .contact i { width: 25px; color: var(--primary); text-align: center; font-size: 1.1em; }
        .section-title { font-size: 1.2rem; font-weight: 700; margin: 1.2rem 0 .5rem; display: flex; align-items: center; letter-spacing: .6px; color: var(--text-dark); text-transform: uppercase; position: relative; padding-left: 20px; z-index: 2; }
        .section-title::before { content: ""; position: absolute; left: 0; top: 50%; transform: translateY(-50%); display: inline-block; width: 10px; height: 10px; background: var(--primary); border-radius: 2px; margin-right: 8px; }
        .section-title::after { content: ""; flex-grow: 1; height: 2px; background: var(--primary); margin-left: 15px; }
        ul.bullets { padding-left: 1.2rem; margin: .1rem 0 .8rem; color: var(--text-light); z-index: 2; position: relative; }
        ul.bullets li { margin: .4rem 0; font-size: .92rem; line-height: 1.4; }
        .experience-item { margin-bottom: 1rem; z-index: 2; position: relative; }
        .experience-item h3 { color: var(--primary); font-size: 1.05rem; margin-bottom: .5rem; }
        @media print {
            body { background: #fff; -webkit-print-color-adjust: exact; print-color-adjust: exact; display: block; padding: 0; }
            #input-panel { display: none; }
            #cv-template { margin: 0 auto; width: 794px; box-shadow: none; padding: 0; page-break-after: always; overflow: visible; }
            #cv-template::before, #cv-template::after { display: none; }
            .cv-header, .profile, .section-title, ul.bullets, .experience-item { margin: 1rem 0; padding: 0 1.5rem; }
            .cv-title, .job-title { padding-left: 1.5rem; }
            .navbar-cv { display: none !important; }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-cv">
        <div class="brand">
            <img src="{{ asset('assets/images/logo3.png') }}" alt="Logo">
            TANNIEWA PUTRA
        </div>
        <div class="nav-links">
            <a href="{{ route('profile') }}"><i class="fas fa-user"></i> Profil</a>
            <a href="{{ route('profile.cv') }}"><i class="fas fa-file-alt"></i> CV</a>
            <a href="{{ route('profile.lowongan') }}"><i class="fas fa-briefcase"></i> Lowongan</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
            <button class="btn-pdf" id="save-pdf-btn"><i class="fas fa-download"></i> Simpan PDF</button>
        </div>
    </nav>

    <div id="input-panel">
        {{-- ...input panel code as before... --}}
        @yield('input-panel')
        <!-- (copy your input panel code here, unchanged) -->
        <!-- ... -->
        <!-- (for brevity, not repeated here, use your existing input panel code) -->
        <!-- ... -->
        <!-- (end input panel) -->
        <!-- Copy all your input panel code from your previous file here -->
        <!-- ... -->
        <h2>Input CV Data</h2>
        <!-- ...rest of input panel code... -->
        <!-- (see your previous code for full content) -->
        <!-- ... -->
    </div>

    <div id="cv-template">
        <div class="cv-header">
            <div>
                <h1 class="cv-title">CV. <span id="cv-title-first">TANNIEWA</span> <span class="last" id="cv-title-last">PUTRA</span></h1>
                <div class="job-title" id="cv-job-title">DIREKTUR | SENIOR SISTEM ANALYST</div>
            </div>
            <img id="company-logo" src="logo3.png" alt="Company Logo">
        </div>
        <!-- ...rest of your CV template code as before... -->
        <!-- (copy your CV template code here, unchanged) -->
        <!-- ... -->
    </div>

    <script>
        // ...existing script for dynamic CV...
        // Save to PDF
        document.addEventListener('DOMContentLoaded', function() {
            // ...existing dynamic CV JS code...
            // Save to PDF
            document.getElementById('save-pdf-btn').addEventListener('click', function () {
                const cv = document.getElementById('cv-template');
                html2canvas(cv, {scale:2}).then(function(canvas) {
                    const imgData = canvas.toDataURL('image/png');
                    const pdf = new window.jspdf.jsPDF('p', 'pt', 'a4');
                    const pageWidth = pdf.internal.pageSize.getWidth();
                    const pageHeight = pdf.internal.pageSize.getHeight();
                    const imgWidth = pageWidth;
                    const imgHeight = canvas.height * imgWidth / canvas.width;
                    pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                    pdf.save('cv-tanniewa-putra.pdf');
                });
            });
            // ...rest of your dynamic CV JS code...
        });
    </script>
</body>
</html>
