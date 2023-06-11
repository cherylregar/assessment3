<?php
header('Content-Type: application/json');

$koneksi = mysqli_connect("localhost", "root", "", "tubestubes");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM kursus";
    $query = mysqli_query($koneksi, $sql);
    $array_data = array();
    while ($data = mysqli_fetch_assoc($query)) {
        $array_data[] = $data;
    }
    echo json_encode($array_data);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idkursus = $_POST['idkursus'];
    $nm_kursus = $_POST['nm_kursus'];
    $nm_pengajar = $_POST['nm_pengajar'];
    $durasi_video = $_POST['durasi_video'];
    $jumlah_modul = $_POST['jumlah_modul'];
    $sql = "INSERT INTO kursus (idkursus, nm_kursus, nm_pengajar, durasi_video, jumlah_modul) VALUES('$idkursus', '$nm_kursus', '$nm_pengajar', '$durasi_video','$jumlah_modul')";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => "gagal"
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $sql = "DELETE FROM kursus WHERE idkursus='$id'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => "gagal"
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $idkursus = $_POST['idkursus'];
    $nm_kursus = $_POST['nm_kursus'];
    $nm_pengajar = $_POST['nm_pengajar'];
    $durasi_video = $_POST['durasi_video'];
    $jumlah_modul = $_POST['jumlah_modul'];

    $sql = "UPDATE kursus SET nm_kursus='$nm_kursus', nm_pengajar='$nm_pengajar', durasi_video='$durasi_video', jumlah_modul='$jumlah_modul' WHERE idkursus='$idkursus'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => 'berhasil'
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => 'gagal'
        ];
        echo json_encode($data);
    }
}
?>
