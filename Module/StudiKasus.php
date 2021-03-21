<?php
require_once './Module/Database.php';

function getKasus()
{
    $query = DB::conn()->prepare("SELECT * FROM kasus");
    $query->execute();
    return $query->fetchAll();
}


function updateTerakhirDiakses($id)
{
    $query = DB::conn()->prepare("UPDATE `kasus` SET `terakhir_diakses` = current_timestamp() WHERE `kasus`.`id` = '$id'");
    $query->execute();
    return $query->rowCount();
}

function updateTerakhirDiedit($id)
{
    $query = DB::conn()->prepare("UPDATE `kasus` SET `terakhir_diedit` = current_timestamp() WHERE `kasus`.`id` = '$id'");
    $query->execute();
    return $query->rowCount();
}
