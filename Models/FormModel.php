<?php
class FormModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli('localhost', 'root', '', 'testaja');
    if ($this->conn->connect_error) {
      die("Koneksi gagal: " . $this->conn->connect_error);
    }
  }

  public function cekDataUser($userId) {
    $stmt = $this->conn->prepare("SELECT * FROM pendaftaran WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  public function simpanPendaftaran($userId, $nama, $nim, $prodi, $jeniskelamin, $kegiatan,
                                    $provinsi, $kabupaten, $kecamatan, $kelurahan,
                                    $alamat, $fotoBase64, $signature) {
    $stmt = $this->conn->prepare("
      INSERT INTO pendaftaran 
      (user_id, nama, nim, prodi, jeniskelamin, kegiatan, provinsi, kabupaten, kecamatan, kelurahan, alamat, foto, tanda_tangan)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
      "issssssssssss",
      $userId, $nama, $nim, $prodi, $jeniskelamin, $kegiatan,
      $provinsi, $kabupaten, $kecamatan, $kelurahan,
      $alamat, $fotoBase64, $signature
    );
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  public function updatePendaftaran($userId, $nama, $nim, $prodi, $jeniskelamin, $kegiatan,
                                    $provinsi, $kabupaten, $kecamatan, $kelurahan,
                                    $alamat, $fotoBase64, $signature) {
    $stmt = $this->conn->prepare("
      UPDATE pendaftaran SET 
        nama=?, nim=?, prodi=?, jeniskelamin=?, kegiatan=?, provinsi=?, kabupaten=?, kecamatan=?, kelurahan=?, alamat=?, foto=?, tanda_tangan=? 
      WHERE user_id=?
    ");
    $stmt->bind_param(
      "ssssssssssssi",
      $nama, $nim, $prodi, $jeniskelamin, $kegiatan,
      $provinsi, $kabupaten, $kecamatan, $kelurahan,
      $alamat, $fotoBase64, $signature, $userId
    );
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }
}
?>
