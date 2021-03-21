<?php
include('Bootstrap.php');
include('Library.php');
// $data_siswa = $lib->show();

// if (isset($_GET['hapus_siswa'])) {
//     $kd_siswa = $_GET['hapus_siswa'];
//     $status_hapus = $lib->delete($kd_siswa);
//     if ($status_hapus) {
//         header('Location: index.php');
//     }
// }
$show = DB::show(1);

?>
<html>

<head>
    <?php echo Bootstrap::header(); ?>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Data Siswa</h3>
            </div>
            <div class="card-body">
                <a href="form_add.php" class="btn btn-success">Tambah</a>
                <hr />
                <table class="table table-bordered" width="60%">
                    <tr>
                        <?php foreach ($show['header'] as $row) : ?>
                            <th><?php echo $row; ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <?php
                    foreach ($show['body'] as $rows) {
                        echo "<tr>";
                        for ($i = 0; $i < count($rows); $i++) {
                            echo "<td>" . $rows[$i] . "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php echo Bootstrap::footer(); ?>
</body>

</html>