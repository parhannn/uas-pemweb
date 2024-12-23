<?php
    require_once 'includes/Connection.php';

    class GuestController extends Connection {
        public function addGuest($name, $nim, $email, $whatsapp, $photo) {
            $connection = $this->getConnection();
            
            try {
                $target_dir = "uploads/";
                $photo_name = time() . "_" . basename($photo["name"]);
                $target_file = $target_dir . $photo_name;
                move_uploaded_file($photo["tmp_name"], $target_file);
                $query = "INSERT INTO tamu (tamu_nama, tamu_nim, tamu_email, tamu_whatsapp, tamu_foto, created_at) 
                          VALUES (?, ?, ?, ?, ?, NOW())";
    
                $stmt = $connection->prepare($query);
                if ($stmt === false) {
                    throw new Exception("Error preparing query: " . $connection->error);
                }
    
                $stmt->bind_param("sssss", $name, $nim, $email, $whatsapp, $photo_name);
    
                $result = $stmt->execute();
                $stmt->close();

                if ($result) {
                    $this->setCookie("last_guest", $name, time() + 3600);
                }
    
                return $result;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function getLecturer() {
            $connection = $this->getConnection();
            $query = "SELECT * FROM dosen";
            $result = $connection->query($query);
            $lecturers = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $lecturers[] = $row;
                }
            }
            return $lecturers;
        }

        private function setCookie($name, $value, $expire, $path = "/", $domain = "", $secure = false, $httpOnly = false) {
            setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
        }

        public function getCookie($name) {
            return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
        }

        public function deleteCookie($name, $path = "/", $domain = "") {
            setcookie($name, "", time() - 3600, $path, $domain);
        }

        public function getLastGuestFromCookie() {
            return $this->getCookie("last_guest");
        }
    }
?>