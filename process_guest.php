<?php
    session_start();
    require_once 'controllers/GuestController.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST['tamu_nama'] ?? null;
        $nim = $_POST['tamu_nim'] ?? null;
        $email = $_POST['tamu_email'] ?? null;
        $whatsapp = $_POST['tamu_whatsapp'] ?? null;
        $photo = $_FILES['tamu_foto'] ?? null;
    
        $guestController = new GuestController();
        $success = $guestController->addGuest($name, $nim, $email, $whatsapp, $photo);
    
        if ($success) {
            header("Location: home.php");
        } else {
            header("Location: ../form.php?message=error");
        }
    }
?>