<?php
class ResultAdminController {
    public function index() {
        $conn = new mysqli('localhost', 'root', '', 'testaja');
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT * FROM pendaftaran ORDER BY id DESC");
        $data = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        $totalData = count($data);

        $conn->close();

        include 'Views/resultadmin.php';
    }
}
?>
