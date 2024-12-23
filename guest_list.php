<?php
    session_start();
    require_once 'controllers/AdminController.php';

    $adminController = new AdminController();
    $guests = $adminController->getGuest();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Buku Tamu Prodi IF | Daftar Tamu</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/list.css">
    <link rel="icon" href="assets/icons/favicon.png" type="image/png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
</head>
<body>
    <nav>
        <label class="logo">
            <span class="logo-text">Admin Buku Tamu Teknik Informatika</span>
            <img src="assets/icons/favicon.png" alt="Logo" class="web-logo" />
        </label>
    </nav>

    <div class="content">
        <h1>Daftar Tamu Prodi IF</h1>
        <div class="btn-container">
            <a href="lecturer_list.php" class="btn">Daftar Dosen</a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Nomor WhatsApp</th>
                    <th>Selfie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guests as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['tamu_nama']) ?></td>
                    <td><?= htmlspecialchars($row['tamu_nim']) ?></td>
                    <td><?= htmlspecialchars($row['tamu_email']) ?></td>
                    <td><?= htmlspecialchars($row['tamu_whatsapp']) ?></td>
                    <td><a href="http://localhost/uas-pemweb/uploads/<?= htmlspecialchars($row['tamu_foto']) ?>" target="_blank" class="btn">Lihat Foto</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
