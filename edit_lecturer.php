<?php
    session_start();
    require_once 'controllers/AdminController.php';

    $adminController = new AdminController();
    $edit_lecturer = $adminController->editLecturer($_POST['id_dosen'], $_POST['dosen_nama'], $_POST['dosen_nip'], $_POST['dosen_email'], $_FILES['dosen_foto']);

    if ($edit_lecturer) {
        header("Location: lecturer_list.php");
    }
?>