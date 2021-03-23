<!DOCTYPE html>
<html lang="en">

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

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed accent-navy" style="height: auto;">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <span class="text-white">Aplikasi Catatan Progres Belajar</span>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">CPB</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="" class="nav-link navigation active" id="dashboard">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link navigation" id="jenis">
                                <i class="fa fa-list-alt nav-icon"></i>
                                <p>Jenis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link navigation" id="bahasa">
                                <i class="far fa-file-code nav-icon"></i>
                                <p>Bahasa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link navigation" id="tingkat">
                                <i class="fas fa-layer-group nav-icon"></i>
                                <p>Tingkat</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            <div id="main-content">
                <h1 class="text-center mt-5" id="loading-text">Loading...</h1>
            </div>
            <div id="detali-data-lengkap" style="display: none;">

            </div>
        </div>
        <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
        <footer class="main-footer"><strong>&copy; 2020 Isep Lutpi Nur </strong></footer>
        <aside class="control-sidebar control-sidebar-dark"></aside>
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
</body>

</html>