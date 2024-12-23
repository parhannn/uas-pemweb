<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Prodi IF | Question</title>
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
        function submitForm() {            
            const nama = document.getElementById("name").value;
            const pesan = document.getElementById("message").value;

            if (nama.length < 3) {
                alert("Nama harus terdiri dari minimal 3 karakter.");
                return;
            }

            if (pesan.length < 5) {
                alert("Pesan harus terdiri dari minimal 5 karakter.");
                return;
            }

            const questionData = {
                nama,
                pesan
            };

            let questionList = 
                JSON.parse(localStorage.getItem("questionList")) || [];
            questionList.push(questionData);
            localStorage.setItem("questionList", JSON.stringify(questionList));

            alert("Data berhasil disimpan ke localStorage.");
            
            document.getElementById("guestForm").reset();
        }
    </script>
</head>
<body>
    <nav>
        <label class="logo">
            <span class="logo-text">Tanya Kami</span>
            <img src="assets/icons/favicon.png" alt="Logo" class="web-logo" />
        </label>
    </nav>

    <div class="content">
        <form id="guestForm" onsubmit="submitForm(event)">
            <label for="name" class="form-label">Nama</label>
            <input type="text" id="name" placeholder="Masukkan Nama" class="form-control" required>

            <label for="message" class="form-label">Pesan</label>
            <textarea id="message" placeholder="Masukkan Pesan" class="form-control" rows="5" required></textarea>

            <div class="btn-container">
                <button type="submit" class="btn">Submit</button>
                <a href="home.php" class="btn">Kembali</a>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Buku Tamu Teknik Informatika</p>
    </footer>
</body>
</html>
