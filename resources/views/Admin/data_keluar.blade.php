<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>FisheerLog - Transaksi</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="{{ route('admin.dashboard') }}" class="logo">
                        <img src="{{ asset('assets/images/LogoFIs.png') }}" class="logo-large" height="500">
                    </a>
                </div>
            </div>
            <div class="sidebar-inner niceScrollleft">
                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Home</li>
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                                <i class="mdi mdi-airplay"></i>
                                <span> Dashboard <span class="badge badge-pill badge-primary float-right"></span></span>
                            </a>
                        </li>
                        <li class="menu-title">Fitur</li>
                        <li>
                            <a href="{{ route('admin.karyawan') }}" class="waves-effect"><i
                                    class="mdi mdi-account-multiple-plus"></i><span> Karyawan </span> <span
                                    class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti ti-receipt"></i><span>
                                    Transaksi </span> <span class="float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('data_masuk') }}">Data Masuk</a></li>
                                <li><a href="{{ route('data_keluar') }}">Data Keluar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('admin.produk') }}" class="waves-effect"><i
                                    class="ti ti-package"></i><span>
                                    Produk </span> <span class="float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti ti-book"></i><span> Modul
                                </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('admin.modul') }}">Modul</a></li>
                                <li><a href="{{ route('admin.tambah_modul') }}">Tambah Modul</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i
                                    class="mdi mdi-calendar-multiple-check"></i><span> Daily Task </span> <span
                                    class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('task') }}">Task</a></li>
                                <li><a href="{{ url('task.tambah') }}">Tambah Task</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                <div class="topbar">

                    <nav class="navbar-custom">

                        <ul class="list-inline float-right mb-0">
                            <!-- language-->
                            <li class="list-inline-item hide-phone app-search">
                                <form role="search" class="">
                                    <input type="text" placeholder="Search..." class="form-control">
                                    <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown"
                                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="ti-bell noti-icon"></i>
                                    <span class="badge badge-success noti-icon-badge">23</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5><span class="badge badge-danger float-right">87</span>Notification</h5>
                                    </div>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-message"></i></div>
                                        <p class="notify-details"><b>Pesan Baru</b><small class="text-muted">Seseorang
                                                menambahkan data masuk</small></p>
                                    </a>
                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        View All
                                    </a>

                                </div>
                            </li>

                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user"
                                        class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5>Welcome</h5>
                                    </div>
                                    <a class="dropdown-item" href="#"><i
                                            class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="mdi mdi-logout m-r-5 text-muted"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </li>

                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </ul>

                        <div class="clearfix"></div>

                    </nav>

                </div>
                <!-- Top Bar End -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group float-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a>Transaksi</a></li>
                                    <li class="breadcrumb-item active" href="data_keluar">Data keluar</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Transaksi</h4>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="page-content-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Data Penjualan Ikan</h4>
                                    <!-- Form untuk menyimpan penjualan ikan -->
                                    <form action="{{ route('store.pembelian_ikan') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="nama-ikan" class="col-sm-2 col-form-label">Nama Ikan</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="nama_ikan"
                                                    placeholder="Masukkan Nama Ikan" id="nama-ikan"
                                                    value="{{ old('nama_ikan') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="deskripsi"
                                                    placeholder="Masukkan Deskripsi (Opsional)" id="deskripsi"
                                                    value="{{ old('nama_pakan') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kolam</label>
                                            <div class="col-sm-10">
                                                <select class="custom-select" id="nama_kolam" name="nama_kolam"
                                                    required>
                                                    <option value="" selected>Pilih Kolam</option>
                                                    <option value="Kolam 1" {{ old('nama_kolam') == 'Kolam 1' ? 'selected' : '' }}>Kolam 1</option>
                                                    <option value="Kolam 2" {{ old('nama_kolam') == 'Kolam 2' ? 'selected' : '' }}>Kolam 2</option>
                                                    <option value="Kolam 3" {{ old('nama_kolam') == 'Kolam 3' ? 'selected' : '' }}>Kolam 3</option>
                                                    <option value="Kolam 4" {{ old('nama_kolam') == 'Kolam 4' ? 'selected' : '' }}>Kolam 4</option>
                                                    <option value="Kolam 5" {{ old('nama_kolam') == 'Kolam 5' ? 'selected' : '' }}>Kolam 5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="jumlah-penjualan" class="col-sm-2 col-form-label">Jumlah
                                                Penjualan</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="number" name="jumlah_penjualan"
                                                    placeholder="Masukkan Jumlah Penjualan" id="jumlah-penjualan"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div> <!-- Page content Wrapper -->


            </div> <!-- content -->
            <footer class="footer">
                © 2024 FisheerLog by Fisheero.
            </footer>
        </div>
        <!-- End Right content here -->
    </div>
    <!-- END wrapper -->
    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>