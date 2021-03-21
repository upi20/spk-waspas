<?php
$route = true;
$page_pilih_kasus = "./pages/kasus/pilih_kasus.php";
$base_url = "http://localhost/aplikasi/spk_waspas/";

if (!isset($_GET['k'])) {
    require_once $page_pilih_kasus;
}

if (!isset($_GET['page'])) {
    require_once $page_pilih_kasus;
}
