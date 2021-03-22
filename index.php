<?php
function base_url($url = '')
{
    $base = "http://localhost/aplikasi/spk_waspas/";
    return $url ? $base . $url : $base;
}

require("pages/route.php");
