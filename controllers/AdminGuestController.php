<?php
    class AdminGuestController extends Connection {
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
    }
?>