<?php
    session_start();

    require_once 'controllers/GuestController.php';

    $guestController = new GuestController();
    $lecturers = $guestController->getLecturer();

    $lastGuest = $guestController->getLastGuestFromCookie();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Prodi IF | Home</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/home.css">
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
</head>
<body>
    <nav>
        <label class="logo">
            <span class="logo-text">Home</span>
            <img src="assets/icons/favicon.png" alt="Logo" class="web-logo" />
        </label>
    </nav>

    <div class="content">
        <h1>Selamat datang di Buku Tamu Prodi IF</h1>
        <p>Anda dapat mengisi buku tamu dengan mengklik tombol di bawah ini.</p>
        <a href="form.php" class="btn">Isi Buku Tamu</a>
        <br>
        <a href="question.php" class="btn">Tanya Kami</a>
        <br>
        <a href="guest_list.php" class="btn">Login Admin</a>
        <br>
        <h2>Daftar Dosen</h2>
        <div class="lecturer-list">
            <?php foreach ($lecturers as $row): ?>
            <div class="lecturer-card">
                <div class="lecturer-photo">
                    <img src="http://localhost/uas-pemweb/images/<?= htmlspecialchars($row['dosen_foto']) ?>" alt="Foto Dosen" />
                </div>
                <div class="lecturer-info">
                    <h2><?= htmlspecialchars($row['dosen_nama']) ?></h2>
                    <p>NIP: <?= htmlspecialchars($row['dosen_nip']) ?></p>
                    <p><?= htmlspecialchars($row['dosen_email']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <br>
    </div>
</body>
</html>
