<?php
$route = true;
require_once './Module/Database.php';
if (!isset($_GET['kasus'])) {
    require_once "./pages/kasus/pilih_kasus.php";
    die;
}

try {
    // Query terakhir diakses
    $id = ($_GET['kasus'] == "") ? 0 : $_GET['kasus'];
    $query = DB::conn()->prepare("UPDATE `kasus` SET `terakhir_diakses` = current_timestamp() WHERE `kasus`.`id` = $id");
    $query->execute();
    if (!($query->rowCount())) {
        require_once "./pages/kasus/pilih_kasus.php";
        die;
    }
} catch (\Throwable $th) {
    require_once "./pages/kasus/pilih_kasus.php";
    die;
}

if (!isset($_GET['page'])) {
    require_once "./pages/dashboard/dashboard.php";
} else {
    switch ($_GET['page']) {
        case 'dashboard':
            break;

        case 'kasus':
            require_once "./pages/kasus/kasus.php";
            break;

        case 'alternatif':
            require_once "./pages/alternatif/alternatif.php";
            break;

        case 'kriteria':
            require_once "./pages/kriteria/kriteria.php";
            break;

        default:
            require_once "./pages/dashboard/dashboard.php";
            break;
    }
}
