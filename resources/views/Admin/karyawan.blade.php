<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>FisheerLog - Karyawan</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- DataTables -->
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

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
        <!-- Left Sidebar Start -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="{{ url('admin.dashboard') }}" class="logo">
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
                            <a href="{{ route('admin.produk') }}" class="waves-effect"><i class="ti ti-package"></i><span>
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
                        <li class=" has_sub">
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
            <div class="content">
                <div class="topbar">
                    <nav class="navbar-custom">
                        <ul class="list-inline float-right mb-0">
                            <li class="list-inline-item hide-phone app-search">
                                <form role="search" class="form-control">
                                    <input type="text" placeholder="Search..." class="form-control">
                                    <a href="">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </form>
                            </li>
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown"
                                    role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="ti-bell noti-icon"></i>
                                    <span class="badge badge-success noti-icon-badge">23</span>
                                </a>
                            </li>
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                                    data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user"
                                        class="rounded-circle">
                                </a>
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

                <div class="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li class="breadcrumb-item"><a
                                                    href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a
                                                    href="{{ route('admin.karyawan') }}">Karyawan</a></li>
                                            <li class="breadcrumb-item active">Data Karyawan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Karyawan</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Data Karyawan -->
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <h5 class="header-title">Data Karyawan</h5>
                                        <button id="addDataBtn" type="button" class="btn-karyawan">Tambah Data</button>

                                        <!-- Form Import -->
                                        <form action="{{ route('admin.karyawan.import') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            @if (session('message'))
                                                <div class="alert alert-success">
                                                    {{ session('message') }}
                                                </div>
                                            @endif

                                            <!-- Input file -->
                                            <div class="form-group">
                                                <label for="file">Pilih File Excel:</label>
                                                <input type="file" name="file" accept=".xls,.xlsx" required
                                                    class="form-control">
                                            </div>

                                            <!-- Tombol submit -->
                                            <button type="submit" class="btn btn-success">Import Data</button>
                                        </form>

                                        <!-- Tabel Karyawan -->
                                        <table id="datatable2" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($karyawan))
                                                    @foreach($karyawan as $employee)
                                                        <tr>
                                                            <td>{{ $employee['username'] }}</td>
                                                            <td>{{ $employee['email'] }}</td>
                                                            <td>
                                                                <form action="{{ route('karyawan.destroy', $employee['id']) }}"
                                                                    method="POST" onsubmit="return confirm('Are you sure?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    @if(auth()->check())
                                                                        <input type="hidden" name="api_token"
                                                                            value="{{ auth()->user()->currentAccessToken()->plainTextToken }}">
                                                                    @endif
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    © 2024 FisheerLog by Fisheero.
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/plugins/skycons/skycons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar/vanillaCalendar.js') }}"></script>
    <script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('assets/pages/dashborad.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- Script untuk menghilangkan loader -->
    <script>
        $(window).on('load', function () {
            $('#preloader').fadeOut('slow', function () {
                $(this).remove();
            });
        });

        $(document).ready(function () {
            $('#datatable2').DataTable();
        });
    </script>

</body>

</html>