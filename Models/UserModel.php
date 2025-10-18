<?php
class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'testaja');
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function cekLogin($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function register($username, $password) {
        $check = $this->conn->prepare("SELECT * FROM users WHERE username=?");
        $check->bind_param("s", $username);
        $check->execute();
        $exists = $check->get_result()->fetch_assoc();

        if ($exists) return false;

        $status = 'user';
        $stmt = $this->conn->prepare("INSERT INTO users (username, password, status) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $status);
        return $stmt->execute();
    }
    
}
?>
