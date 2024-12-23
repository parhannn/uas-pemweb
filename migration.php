<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "buku_tamu_prodi";
    
    $conn = new mysqli($host, $username, $password);
    
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql_create_db = "CREATE DATABASE IF NOT EXISTS $database";
    if ($conn->query($sql_create_db) === TRUE) {
        echo "Database '$database' berhasil dibuat atau sudah ada.<br>";
    } else {
        die("Gagal membuat database: " . $conn->error);
    }

    $conn->select_db("buku_tamu_prodi");

    $sql_create_table_tamu = "
    CREATE TABLE IF NOT EXISTS tamu (
        id_tamu INT PRIMARY KEY AUTO_INCREMENT,
        tamu_nama VARCHAR(100) NOT NULL,
        tamu_nim VARCHAR(15) NOT NULL,
        tamu_email VARCHAR(100) NOT NULL,
        tamu_whatsapp VARCHAR(20) NOT NULL,
        tamu_foto VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
    ";

    if ($conn->query($sql_create_table_tamu) === TRUE) {
        echo "Table tamu created successfully.<br>";
    } else {
        echo "Error creating table tamu: " . $conn->error;
    }

    $sql_create_table_dosen = "
    CREATE TABLE IF NOT EXISTS dosen (
        id_dosen INT PRIMARY KEY AUTO_INCREMENT,
        dosen_nama VARCHAR(100) NOT NULL,
        dosen_nip VARCHAR(25) NOT NULL,
        dosen_email VARCHAR(100) NOT NULL,
        dosen_foto VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
    ";

    if ($conn->query($sql_create_table_dosen) === TRUE) {
        echo "Table dosen created successfully.<br>";
    } else {
        echo "Error creating table dosen: " . $conn->error;
    }

    $conn->close();
    echo "Migration completed";
?>