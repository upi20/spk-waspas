<?php
if (!isset($route)) die;
require_once "./Module/StudiKasus.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pilih Studi Kasus</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="./pages/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="./pages/assets/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./pages/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./pages/assets/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <!-- pilih kasus -->
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>SPK</b></a>
            <h5>METODE WASPAS (WEIGHTED AGGREGATED SUM PRODUCT ASSESSMENT)</h5>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan pilih atau buat studi kasus baru.</p>

                <!-- Studi kasus -->
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item active">
                        Studi Kasus
                        <span class="float-right">Terakhir diakses</span>
                    </li>
                    <?php foreach (getKasus() as $kasus) : ?>
                        <li class="nav-item">
                            <a href="?k=<?php echo $kasus['id'] ?>" class="nav-link">
                                <i class="far fa-file-alt"></i> <?php echo $kasus['kasus_nama']; ?>
                                <span class="float-right"><?php echo $kasus['terakhir_diakses']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>

                </ul>

                <!-- Button -->
                <button type="button" class="btn btn-primary btn-block mt-3 btn-buat-studi-kasus-baru">Buat studi kasus baru</button>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    <!-- Buat Baru -->
    <div class="register-box" style="display: none;">
        <div class="register-logo">
            <a href="#">Buat studi kasus baru</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <form id="form-buat">
                    <div class="form-group mb-3">
                        <label for="baru-keterangan">Nama Studi Kasus</label>
                        <input type="text" class="form-control" placeholder="Nama" id="baru-nama" name="nama">
                        <div class="invalid-feedback">
                            Nama studi kasus sudah ada dan kolom tidak boleh kosong.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="baru-keterangan">Keterangan</label>
                        <textarea class="form-control" id="baru-keterangan" rows="3"></textarea>
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <button class="btn btn-block btn-primary" id="buat">
                        Buat Studi Kasus Baru
                    </button>
                    <button class="btn btn-block btn-danger" id="batal">
                        Batal </button>
                </div>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="./pages/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./pages/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./pages/assets/js/adminlte.min.js"></script>
    <script>
        // validasi nama
        function cekNama(namaBaru) {
            if (typeof(namaBaru) != 'string') return true;
            if (namaBaru == '') return false;
            let kumpulanNamaStudiKasus = [];
            let i = 0;
            let result = true;
            <?php foreach (getKasus() as $kasus) : ?>
                kumpulanNamaStudiKasus[i] = '<?php echo $kasus['kasus_nama']; ?>';
                i++;
            <?php endforeach; ?>

            kumpulanNamaStudiKasus.forEach((e) => {
                if (e.toUpperCase() == namaBaru.toUpperCase()) result = false;
            });

            return result;
        }

        // button buat baru onclick
        $(document).on('click', '.btn-buat-studi-kasus-baru', function() {
            $('.login-box').fadeOut(200, () => {
                $('.register-box').fadeIn(200);
            });
        });

        // button batal onclick
        $(document).on('click', '#batal', function() {
            $('.register-box').fadeOut(200, () => {
                $('.login-box').fadeIn(200);
            });
        });

        // Button buat kasus baru onclick
        $(document).on('click', '#buat', function() {
            let namaBaru = $('#baru-nama');
            if (cekNama(namaBaru.val())) {
                namaBaru.removeClass('is-invalid');



            } else {
                namaBaru.addClass('is-invalid');
            }
        });

        // Nama baru onclick
        $('#baru-nama').on('keyup', function() {
            if (cekNama($(this).val())) {
                $(this).removeClass('is-invalid');
            } else {
                $(this).addClass('is-invalid');
            }
        });
    </script>

</body>

</html>