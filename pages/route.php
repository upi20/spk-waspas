<?php
$route = true;

if (!isset($_GET['kasus'])) {
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
