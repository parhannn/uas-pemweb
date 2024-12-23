<?php
    class GuestFormController extends Connection {
        public function addGuest($name, $nim, $email, $whatsapp, $photo) {
            $connection = $this->getConnection();
            
            try {
                $target_dir = "../uploads/";
                $photo_name = time() . "_" . basename($photo["name"]);
                $target_file = $target_dir . $photo_name;
                move_uploaded_file($photo["tmp_name"], $target_file);

                $query = "INSERT INTO tamu (tamu_nama, tamu_nim, tamu_email, tamu_whatsapp, tamu_foto, created_at) 
                      VALUES (:name, :nim, :email, :whatsapp, :photo, NOW())";

                $stmt = $connection->prepare($query);
                if ($stmt === false) {
                    throw new Exception("Error preparing query: " . $connection->error);
                }
    
                $stmt->bind_param("sssss", $name, $nim, $email, $whatsapp, $photo_name);
    
                $result = $stmt->execute();
                $stmt->close();

                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
?>