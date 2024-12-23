<?php
class Connection {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'buku_tamu_prodi';
    private $connect;

    public function __construct() 
    {
        $this->connect = new mysqli(
            $this->host, 
            $this->username, 
            $this->password, 
            $this->database
        );
            
        if ($this->connect->connect_error) {
            die('Connection failed: ' . $this->connect->connect_error);
        }
    }

    public function getConnection() 
    {
        return $this->connect;
    }
}
?>