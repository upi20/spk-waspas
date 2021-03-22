<?php
if (!isset($route)) die;
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
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="./pages/assets/plugins/sweetalert2/sweetalert2.min.css">
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
                <ul class="nav nav-pills flex-column" id="studi-kasus-list">

                </ul>

                <!-- Button -->
                <button type="button" class="btn btn-primary btn-block mt-3 btn-buat-studi-kasus-baru">Buat studi kasus baru</button>
                <button class="btn btn-block btn-danger" id="edit"> Edit </button>
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
                        <input type="text" class="form-control" placeholder="Nama" id="baru-nama" name="baru-nama">
                        <div class="invalid-feedback">
                            Nama studi kasus sudah ada dan kolom tidak boleh kosong.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="baru-keterangan">Keterangan</label>
                        <textarea class="form-control" id="baru-keterangan" name="baru-keterangan" rows="3"></textarea>
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
    <!-- Loading overlay -->
    <script src="./pages/assets/plugins/jquery-loading-overlay-2.1.7/dist/loadingoverlay.min.js"></script>
    <!-- sweetalert -->
    <script src="./pages/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        let kumpulanNamaStudiKasus = [];
        $(document).ajaxStart(function() {
            $.LoadingOverlay("show");
        });
        $(document).ajaxStop(function() {
            $.LoadingOverlay("hide");
        });


        // Get list data
        const getListData = async () => $.ajax({
            url: '<?= base_url('api/index.php?api=kasus&aksi=get-all-data') ?>',
            type: 'get',
            cache: false,
            dataType: 'json',
            success: function(response) {
                let html = `
                <li class="nav-item active">
                    Studi Kasus
                    <span class="float-right">Terakhir diakses</span>
                </li>
                `;
                let namaStudiKasus = [];
                response.data.forEach((e, i) => {
                    namaStudiKasus[i] = e.kasus_nama;
                    html += `
                    <li class="nav-item">
                            <a href="?kasus=${e.id}" class="nav-link">
                                <i class="far fa-file-alt"></i> ${e.kasus_nama}
                                <span class="float-right">${e.terakhir_diakses}</span>
                            </a>
                        </li>
                    `;
                });

                $('#studi-kasus-list').html(html);
                kumpulanNamaStudiKasus = namaStudiKasus;
            },
            failed: function(xhr) {
                alert(xhr.status);
            }
        });
        getListData();


        // validasi nama
        function cekNama(namaBaru) {
            if (typeof(namaBaru) != 'string') return true;
            if (namaBaru == '') return false;
            result = true;
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
            if (!cekNama(namaBaru.val())) {
                namaBaru.addClass('is-invalid');
            } else {
                namaBaru.removeClass('is-invalid');
                const eksekusi = async () => {
                    var data = $('#form-buat').serialize();
                    $.ajax({
                        url: '<?= base_url('api/index.php?api=kasus&aksi=tambah') ?>',
                        data: data,
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        success: function(response) {
                            getListData();
                            Swal.fire(
                                'Berhasil',
                                'Kasus baru berhasil ditambahkan',
                                'success'
                            );

                            $('#baru-nama').val('');
                            $('#baru-keterangan').val('');

                        },
                        failed: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire(
                                'Gagal',
                                'Kasus baru gagal ditambahkan',
                                'error'
                            );
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire(
                                'Gagal',
                                'Kasus baru gagal ditambahkan',
                                'error'
                            );
                        },
                        complete: function() {
                            $('#tambahSubkriteria').fadeOut(1000, function() {
                                $('#tambah_nama').val('');
                                $('#daftarSubkriteria').load('<?= base_url('subkriteria/lihat_subkriteria') ?>');
                                $('#tambahSubkriteria').fadeIn(1000);
                            });
                        }
                    });
                }
                $.LoadingOverlay("show");
                eksekusi();
                $.LoadingOverlay("hide");

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

        $('#baru-nama').on('click', function() {
            if (cekNama($(this).val())) {
                $(this).removeClass('is-invalid');
            } else {
                $(this).addClass('is-invalid');
            }
        });
    </script>

</body>

</html>