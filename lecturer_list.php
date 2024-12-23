<?php
    session_start();

    require_once 'controllers/GuestController.php';

    $guestController = new GuestController();
    $lecturers = $guestController->getLecturer();
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
        <h1>Daftar Dosen Prodi IF</h1>
        <div class="btn-container">
            <a href="guest_list.php" class="btn">Daftar Tamu</a>
            <button class="btn add-btn">Tambah Dosen</button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lecturers as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['dosen_nama']) ?></td>
                    <td><?= htmlspecialchars($row['dosen_nip']) ?></td>
                    <td><?= htmlspecialchars($row['dosen_email']) ?></td>
                    <td><a href="http://localhost/uas-pemweb/images/<?= htmlspecialchars($row['dosen_foto']) ?>" target="_blank" class="btn">Lihat Foto</a></td>
                    <td>
                        <button class="btn green-btn edit-btn" 
                                data-id_dosen="<?= $row['id_dosen'] ?>" 
                                data-dosen_nama="<?= htmlspecialchars($row['dosen_nama']) ?>" 
                                data-dosen_nip="<?= htmlspecialchars($row['dosen_nip']) ?>" 
                                data-dosen_email="<?= htmlspecialchars($row['dosen_email']) ?>">
                            Edit
                        </button>
                        <a href="delete_lecturer.php?id=<?= $row['id_dosen'] ?>" 
                           onclick="return confirm('Hapus data ini?')" 
                           class="btn red-btn">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
    </div>

    <div id="addModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-btn" id="closeModalAdd">&times;</span>
            <h2>Tambah Dosen</h2>
            <form action="process_lecturer.php" id="addForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <label class="form-label">Nama</label>
                <input type="text" name="dosen_nama" id="addName" class="form-control" required>
                
                <label class="form-label">NIP</label>
                <input type="number" name="dosen_nip" id="addNip" class="form-control" required>
                
                <label class="form-label">Email</label>
                <input type="email" name="dosen_email" id="addEmail" class="form-control" required>

                <label class="form-label">Foto</label>
                <input type="file" name="dosen_foto" id="addPhoto" class="form-control" required>

                <div class="btn-container">
                    <button type="submit" class="btn green-btn">Simpan</button>
                    <button type="button" class="btn red-btn" id="cancelAdd">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-btn" id="closeModalEdit">&times;</span>
            <h2>Edit Dosen</h2>
            <form action="edit_lecturer.php" id="addForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <input type="hidden" name="id_dosen" id="editId">
                <label class="form-label">Nama</label>
                <input type="text" name="dosen_nama" id="editName" class="form-control" required>
                
                <label class="form-label">NIP</label>
                <input type="number" name="dosen_nip" id="editNip" class="form-control" required>
                
                <label class="form-label">Email</label>
                <input type="email" name="dosen_email" id="editEmail" class="form-control" required>

                <label class="form-label">Foto</label>
                <input type="file" name="dosen_foto" id="editPhoto" class="form-control">

                <div class="btn-container">
                    <button type="submit" class="btn green-btn">Simpan</button>
                    <button type="button" class="btn red-btn" id="cancelEdit">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addBtn = document.querySelector(".add-btn");
        const addModal = document.getElementById("addModal");
        const closeBtnAdd = document.getElementById("closeModalAdd");
        const cancelBtn = document.getElementById("cancelAdd");

        addBtn.addEventListener("click", () => {
            addModal.style.display = "block";
        });

        closeBtnAdd.addEventListener("click", () => {
            addModal.style.display = "none";
        });

        cancelBtn.addEventListener("click", () => {
            addModal.style.display = "none";
        });

        window.addEventListener("click", (e) => {
            if (e.target === addModal) {
                addModal.style.display = "none";
            }
        });

        const editBtns = document.querySelectorAll(".edit-btn");
        const editModal = document.getElementById("editModal");
        const closeBtnEdit = document.getElementById("closeModalEdit");
        const cancelEdit = document.getElementById("cancelEdit");

        cancelEdit.addEventListener("click", () => {
            editModal.style.display = "none";
        });

        closeBtnEdit.addEventListener("click", () => {
            editModal.style.display = "none";
        });

        editBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                editModal.style.display = "block";
                const id = btn.getAttribute("data-id_dosen");
                const name = btn.getAttribute("data-dosen_nama");
                const nip = btn.getAttribute("data-dosen_nip");
                const email = btn.getAttribute("data-dosen_email");
                const photo = btn.getAttribute("data-dosen_foto");

                const form = editModal.querySelector("form");
                form.querySelector("#editId").value = id;
                form.querySelector("#editName").value = name;
                form.querySelector("#editEmail").value = email;
                form.querySelector("#editNip").value = nip;
                form.querySelector("#editPhoto").value = photo;
            });
        });

        window.addEventListener("click", (e) => {
            if (e.target === editModal) {
                editModal.style.display = "none";
            }
        });

        function validateForm() {
            const file = document.getElementById("photo").files[0];
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
</body>
</html>