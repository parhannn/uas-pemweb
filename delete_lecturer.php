<?php
    session_start();
    require_once 'controllers/AdminController.php';

    $adminController = new AdminController();
    $delete_lecturer = $adminController->deleteLecturer($_GET['id']);

    if ($delete_lecturer) {
        header("Location: lecturer_list.php");
    }
?>