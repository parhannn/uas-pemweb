<?php
    session_start();
    require_once 'controllers/AdminController.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST['dosen_nama'] ?? null;
        $nip = $_POST['dosen_nip'] ?? null;
        $email = $_POST['dosen_email'] ?? null;
        $photo = $_FILES['dosen_foto'] ?? null;
    
        $adminController = new AdminController();
        $success = $adminController->addLecturer($name, $nip, $email, $photo);
    
        if ($success) {
            header("Location: lecturer_list.php");
        } 
    }
?>