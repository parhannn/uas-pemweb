<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Prodi IF | Form</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="icon" href="assets/icons/favicon.png" type="image/png"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script>
        function validateForm() {
            const name = document.getElementById("name").value.trim();
            const nim = document.getElementById("nim").value.trim();
            const email = document.getElementById("email").value.trim();
            const whatsapp = document.getElementById("whatsapp").value.trim();
            const fileInput = document.getElementById("photo");
            const file = fileInput.files[0];

            if (name.length < 3) {
                alert("Nama harus terdiri dari minimal 3 karakter.");
                return false;
            }

            if (nim.length !== 9 || isNaN(nim)) {
                alert("NIM harus berupa 9 digit angka.");
                return false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Email tidak valid.");
                return false;
            }

            const whatsappRegex = /^[0-9]{10,13}$/;
            if (!whatsappRegex.test(whatsapp)) {
                alert("Nomor WhatsApp tidak valid. Gunakan 10-13 digit angka.");
                return false;
            }

            if (!file) {
                alert("Unggah foto selfie Anda.");
                return false;
            }

            const allowedExtensions = ["png", "jpeg", "jpg"];
            const fileExtension = file.name.split(".").pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                alert("Format foto harus berupa PNG, JPEG, atau JPG.");
                return false;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert("Ukuran foto tidak boleh lebih dari 2MB.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <nav>
        <label class="logo">
            <span class="logo-text">Buku Tamu Teknik Informatika</span>
            <img src="assets/icons/favicon.png" alt="Logo" class="web-logo" />
        </label>
    </nav>

    <div class="content">
        <h1>Formulir Buku Tamu IF</h1>
        <form action="process_guest.php" name="guestForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="name" class="form-label">Nama</label>
            <input type="text" id="name" placeholder="Masukkan Nama" name="tamu_nama" class="form-control" required>

            <label for="nim" class="form-label">NIM</label>
            <input type="text" id="nim" placeholder="Masukkan NIM" name="tamu_nim" class="form-control" required>

            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" placeholder="Masukkan Email (Disarankan Email Kampus)" name="tamu_email" class="form-control" required>

            <label for="whatsapp" class="form-label">Nomor WhatsApp</label>
            <input type="text" id="whatsapp" placeholder="Masukkan Nomor Whatsapp" name="tamu_whatsapp" class="form-control" required>

            <label for="photo" class="form-label">Upload Foto Selfie</label>
            <input type="file" id="photo" name="tamu_foto" accept=".jpg,.jpeg,.png" class="form-control" required>

            <div class="btn-container">
                <button type="submit" class="btn">Submit</button>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Buku Tamu Teknik Informatika</p>
    </footer>
</body>
</html>
