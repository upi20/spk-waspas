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
    <div class="login-box" id="display-list-kasus">
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
                <button type="button" class="btn btn-primary btn-block mt-3" onclick="changeDisplay('display-form-baru')">Buat studi kasus baru</button>
                <button class="btn btn-block btn-secondary" onclick="changeDisplay('display-list-kasus-edit')"> Edit </button>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    <!-- Buat Baru -->
    <div class="register-box" id='display-form-baru' style="display: none;">
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
                            Nama studi kasus sudah ada atau kolom tidak boleh kosong.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="baru-keterangan">Keterangan</label>
                        <textarea class="form-control" id="baru-keterangan" name="baru-keterangan" rows="3"></textarea>
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <button class="btn btn-block btn-primary" onclick="simpanKasusBaru()">
                        Buat Studi Kasus Baru
                    </button>
                    <button class="btn btn-block btn-secondary" onclick="changeDisplay('display-list-kasus')">
                        Batal </button>
                </div>
            </div>
        </div>
    </div>

    <!-- kasus edit -->
    <div class="login-box" id="display-list-kasus-edit" style="display: none">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Edit sutdi kasus</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Studi kasus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="studi-kasus-edit">

                    </tbody>
                </table>

                <!-- Button -->
                <button type="button" class="btn btn-secondary btn-block mt-3" onclick="changeDisplay('display-list-kasus')">Batal</button>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    <!-- editor display -->
    <div class="register-box" id='display-form-edit-studi-kasus' style="display: none;">
        <div class="register-logo">
            <a href="#">Edit studi kasus</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <form id="form-edit">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" style="display: none;" id="edit-id" name="edit-id">
                        <input type="text" class="form-control" style="display: none;" id="edit-nama-asal" name="edit-nama-asal">
                        <label for="edit-keterangan">Nama Studi Kasus</label>
                        <input type="text" class="form-control" placeholder="Nama" id="edit-nama" name="edit-nama">
                        <div class="invalid-feedback">
                            Nama studi kasus sudah ada atau kolom tidak boleh kosong.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="baru-keterangan">Keterangan</label>
                        <textarea class="form-control" id="edit-keterangan" name="edit-keterangan" rows="3"></textarea>
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <button class="btn btn-block btn-primary" onclick="simpanEdit()">
                        Edit Studi Kasus Baru
                    </button>
                    <button class="btn btn-block btn-secondary" onclick="changeDisplay('display-list-kasus-edit')">
                        Batal </button>
                </div>
            </div>
        </div>
    </div>


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
        // setting
        let studiKasus = [];
        const displayDefault = 'display-list-kasus';
        let currentDisplay = displayDefault;
        let currentName = '';

        // loading display
        $(document).ajaxStart(function() {
            $.LoadingOverlay("show");
        });
        $(document).ajaxStop(function() {
            $.LoadingOverlay("hide");
        });

        // pemilihan display
        const changeDisplay = (d) => {
            $('#' + currentDisplay).fadeOut(200, () => {
                $('#' + d).fadeIn(200);
                currentDisplay = d;
            });
        }

        // render list kasus
        const renderListKasus = () => {
            let html = `
                <li class="nav-item active">
                    Studi Kasus
                    <span class="float-right">Terakhir diakses</span>
                </li>
                `;

            studiKasus.forEach((e) => {
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
        }

        // render list kasus edit
        const renderListKasusEdit = () => {
            let html = ``;

            studiKasus.forEach((e) => {
                html += `
                        <tr>
                            <td>
                                ${e.kasus_nama}
                            </td>
                            <td  class="text-nowrap">                        
                                <button type="button" class="btn btn-sm btn-warning" onclick="studiKasusBtnEditHandle(${e.id})"><i class="fas fa-pencil-alt"></i></button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="studiKasusBtnDeleteHandle(${e.id})"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    `;
            });
            $('#studi-kasus-edit').html(html);
        }

        // button studi kasus handle
        function studiKasusBtnEditHandle(id) {
            studiKasus.forEach((e) => {
                if (e.id == id) {
                    changeDisplay('display-form-edit-studi-kasus');
                    $('#edit-id').val(e.id);
                    $('#edit-nama').val(e.kasus_nama);
                    $('#edit-nama-asal').val(e.kasus_nama);
                    $('#edit-keterangan').val(e.deskripsi);
                }
            });
        }

        // Edit sutdi kasus aksi
        function simpanEdit() {
            let namaBaru = $('#edit-nama');
            let namaAsal = $('#edit-nama-asal');
            if ((namaAsal.val() == namaBaru.val()) ? false : (!cekNama(namaBaru.val()))) {
                namaBaru.addClass('is-invalid');
            } else {
                namaBaru.removeClass('is-invalid');
                var data = $('#form-edit').serialize();
                $.ajax({
                    url: '<?= base_url('api/index.php?api=kasus&aksi=edit') ?>',
                    data: data,
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    success: function(response) {
                        getListData();
                        Swal.fire(
                            'Berhasil',
                            'Studi kasus berhasi diedit',
                            'success'
                        );
                    },
                    failed: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire(
                            'Gagal',
                            'Studi Kasus gagal diedit',
                            'error'
                        );
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire(
                            'Gagal',
                            'Studi Kasus gagal diedit',
                            'error'
                        );
                    }
                });
            }
        }

        // button delete handle
        function studiKasusBtnDeleteHandle(id) {
            let nama = "";
            const deleteAction = (id) => {
                $.ajax({
                    url: '<?= base_url('api/index.php?api=kasus&aksi=delete&id=') ?>' + id,
                    type: 'get',
                    cache: false,
                    dataType: 'json',
                    success: function(response) {
                        getListData();
                        Swal.fire(
                            'Berhasil',
                            'Studi kasus berhasi dihapus',
                            'success'
                        );
                    },
                    failed: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire(
                            'Gagal',
                            'Studi Kasus gagal dihapus',
                            'error'
                        );
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire(
                            'Gagal',
                            'Studi Kasus gagal dihapus',
                            'error'
                        );
                    }
                });
            }

            studiKasus.forEach((e) => {
                if (e.id == id) {
                    nama = e.kasus_nama;
                }
            });
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: `Anda akan menghapus seluruh data studi kasus ${nama.toUpperCase()}.!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value == true) {
                    deleteAction(id);
                }
            })
        }

        // Get list data
        const getListData = async () => $.ajax({
            url: '<?= base_url('api/index.php?api=kasus&aksi=get-all-data') ?>',
            type: 'get',
            cache: false,
            dataType: 'json',
            success: function(response) {
                studiKasus = response.data;
                renderListKasus();
                renderListKasusEdit();
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
            studiKasus.forEach((e) => {
                if (e.kasus_nama.toUpperCase() == namaBaru.toUpperCase()) result = false;
            });

            return result;
        }

        // Button buat kasus baru onclick
        function simpanKasusBaru() {
            let namaBaru = $('#baru-nama');
            if (!cekNama(namaBaru.val())) {
                namaBaru.addClass('is-invalid');
            } else {
                namaBaru.removeClass('is-invalid');
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
                    }
                });
            }
        }
    </script>

</body>

</html>