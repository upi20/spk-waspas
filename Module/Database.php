<?php
class DB
{
    public static function conn()
    {
        $host = "127.0.0.1:3307";
        $dbname = "spk_waspas";
        $username = "root";
        $password = "";
        $conn = NULL;
        if ($conn == NULL) {
            try {
                $conn = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'PDO Error: ' . $e->getMessage();
            }
        }
        return $conn;
    }
}
