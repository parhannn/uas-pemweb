<?php
    require_once 'includes/Connection.php';

    class AdminController extends Connection {
        public function getGuest() {
            $connection = $this->getConnection();
            $query = "SELECT * FROM tamu";
            $result = $connection->query($query);
            $guests = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $guests[] = $row;
                }
            }
            return $guests;
        }

        public function addLecturer($name, $nip, $email, $photo) {
            $connection = $this->getConnection();
            
            try {
                $target_dir = "images/";
                $photo_name = time() . "_" . basename($photo["name"]);
                $target_file = $target_dir . $photo_name;
                move_uploaded_file($photo["tmp_name"], $target_file);
                $query = "INSERT INTO dosen (dosen_nama, dosen_nip, dosen_email, dosen_foto, created_at) 
                          VALUES (?, ?, ?, ?, NOW())";
    
                $stmt = $connection->prepare($query);
                if ($stmt === false) {
                    throw new Exception("Error preparing query: " . $connection->error);
                }
    
                $stmt->bind_param("ssss", $name, $nip, $email, $photo_name);
    
                $result = $stmt->execute();
                $stmt->close();
    
                return $result;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function deleteLecturer($id) {
            $connection = $this->getConnection();
            $query = "DELETE FROM dosen WHERE id_dosen = ?";
            $stmt = $connection->prepare($query);
            if ($stmt === false) {
                throw new Exception("Error preparing query: " . $connection->error);
            }
            $stmt->bind_param("i", $id);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }

        public function editLecturer($id, $name, $nip, $email, $photo) {
            $connection = $this->getConnection();
        
            $query = "SELECT dosen_foto FROM dosen WHERE id_dosen = ?";
            $stmt = $connection->prepare($query);
            if ($stmt === false) {
                throw new Exception("Error preparing query: " . $connection->error);
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($old_photo);
            $stmt->fetch();
            $stmt->close();
        
            if ($photo["name"]) {
                $target_dir = "images/";
                $photo_name = time() . "_" . basename($photo["name"]);
                $target_file = $target_dir . $photo_name;
                move_uploaded_file($photo["tmp_name"], $target_file);
                if (file_exists($target_dir . $old_photo)) {
                    unlink($target_dir . $old_photo);
                }
            } else {
                $photo_name = $old_photo;
            }
        
            $query = "UPDATE dosen SET dosen_nama = ?, dosen_nip = ?, dosen_email = ?, dosen_foto = ? WHERE id_dosen = ?";
            $stmt = $connection->prepare($query);
            if ($stmt === false) {
                throw new Exception("Error preparing query: " . $connection->error);
            }
            $stmt->bind_param("ssssi", $name, $nip, $email, $photo_name, $id);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }        
    }
?>