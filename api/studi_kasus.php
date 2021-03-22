<?php
require_once "../Module/Database.php";
if (isset($_GET['aksi'])) {
    switch ($_GET['aksi']) {
        case 'tambah':
            $nama = ($_POST['baru-nama']);
            $keterangan = $_POST['baru-keterangan'];
            if (insertData($nama, $keterangan)) {
                responseResult([], 201, true, "data was succesfully added");
            } else {
                responseResult([], 500, false, "internal server error");
            }
            break;

        case 'get-all-data':
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $data = getKasus($id);
            if ($data) {
                responseResult($data, 200, true, "successfully retieved data");
            } else {
                responseResult([], 404, false, "not found");
            }
            break;

        default:
            responseResult();
            break;
    }
} else {
    responseResult();
}

// Fucnction
function insertData($nama, $keterangan)
{
    try {
        $query = DB::conn()->prepare("INSERT INTO kasus (id, kasus_nama, dibuat, terakhir_diakses, terakhir_diedit, Deskripsi)  VALUES (NULL, ?, current_timestamp(), current_timestamp(), current_timestamp(), ?)");
        $query->bindParam(1, $nama);
        $query->bindParam(2, $keterangan);
        $query->execute();
        return $query->rowCount();
    } catch (\Throwable $th) {
        return false;
    }
}

function getKasus($id)
{
    $id =  $id ? " where id = $id" : "";
    try {
        $query = DB::conn()->prepare("SELECT * FROM kasus" . $id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
        return false;
    }
}
