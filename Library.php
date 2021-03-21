<?php
class DB
{
    public static function conn()
    {
        $host = "localhost:3307";
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

    public static function getKriteria($id_kasus)
    {

        $query = DB::conn()->prepare("SELECT * FROM kriteria where id_kasus = '1'");
        $query->execute();
        $query->bindParam(1, $id_kasus);
        $data = $query->fetchAll();
        return $data;
    }

    public static function getAlternatif($id_kasus)
    {
        $query = DB::conn()->prepare("SELECT * FROM alternatif where id_kasus = '1'");
        $query->execute();
        $query->bindParam(1, $id_kasus);
        $data = $query->fetchAll();
        return $data;
    }

    public static function getNilai($kasus, $alternatif, $kriteria)
    {
        $query = DB::conn()->prepare("SELECT * from alternatif_nilai where id_kasus = ? and id_alternatif = ? and id_kriteria = ? ");
        $query->bindParam(1, $kasus);
        $query->bindParam(2, $alternatif);
        $query->bindParam(3, $kriteria);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function show($id_kasus)
    {
        $result = ['header' => ['No', 'Alternatif']];

        $alternatif = DB::getAlternatif($id_kasus);
        $kriteria = DB::getKriteria($id_kasus);
        foreach ($kriteria as $k) {
            array_push($result['header'], $k['kriteria_nama']);
        }

        foreach ($alternatif as $a) {
            $no = 1;
            $row = [$no, $a['alternatif_nama']];

            foreach ($kriteria as $k) {
                $q = DB::getNilai($id_kasus, $a['id'], $k['id']);
                array_push($row, (float)$q['nilai']);
            }
            if (isset($result['body'])) {
                array_push($result['body'], $row);
            } else {
                $result['body'][] = $row;
            }
            $no++;
        }

        return $result;
    }
}
