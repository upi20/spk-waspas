<?php
$route = true;
$page_pilih_kasus = "./pages/kasus/pilih_kasus.php";

if (!isset($_GET['kasus'])) {
    require_once $page_pilih_kasus;
}

if (!isset($_GET['page'])) {
    require_once $page_pilih_kasus;
}
