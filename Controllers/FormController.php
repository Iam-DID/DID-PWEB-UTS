<?php
require_once 'Models/FormModel.php';

class FormController {
  public function showForm() {
    if (!isset($_SESSION['user'])) {
      header("Location: index.php?page=login");
      exit;
    }

    $model = new FormModel();
    $userId = $_SESSION['user']['id'];
    $dataUser = $model->cekDataUser($userId);
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nama = $_POST["nama"] ?? "";
      $nim = $_POST["nim"] ?? "";
      $prodi = $_POST["prodi"] ?? "";
      $jeniskelamin = $_POST["jeniskelamin"] ?? "";
      $kegiatan = isset($_POST["kegiatan"]) ? implode(", ", (array)$_POST["kegiatan"]) : "";
      $provinsi = $_POST["provinsi"] ?? "";
      $kabupaten = $_POST["kabupaten"] ?? "";
      $kecamatan = $_POST["kecamatan"] ?? "";
      $kelurahan = $_POST["kelurahan"] ?? "";
      $alamat = $_POST["inputTextarea"] ?? "";
      $signature = $_POST["signature"] ?? "";

      $fotoBase64 = $dataUser['foto'] ?? null;
      if (isset($_FILES["inputFile"]) && $_FILES["inputFile"]["error"] === 0) {
        $fileType = mime_content_type($_FILES["inputFile"]["tmp_name"]);
        $fileData = base64_encode(file_get_contents($_FILES["inputFile"]["tmp_name"]));
        $fotoBase64 = "data:$fileType;base64,$fileData";
      }

      if ($dataUser) {
        $hasil = $model->updatePendaftaran(
          $userId, $nama, $nim, $prodi, $jeniskelamin, $kegiatan,
          $provinsi, $kabupaten, $kecamatan, $kelurahan,
          $alamat, $fotoBase64, $signature
        );
        $message = $hasil ? "✅ Data berhasil diperbarui!" : "❌ Gagal memperbarui data.";
      } else {
        $hasil = $model->simpanPendaftaran(
          $userId, $nama, $nim, $prodi, $jeniskelamin, $kegiatan,
          $provinsi, $kabupaten, $kecamatan, $kelurahan,
          $alamat, $fotoBase64, $signature
        );
        $message = $hasil ? "✅ Data berhasil disimpan!" : "❌ Gagal menyimpan data.";
      }

      $dataUser = $model->cekDataUser($userId);
    }

    include 'Views/form.php';
  }
}
?>
