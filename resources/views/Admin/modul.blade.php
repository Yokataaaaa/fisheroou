<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>FisheerLog - Modul</title>
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

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="{{ url('Dashboard.html') }}" class="logo">
                        <img src="{{ asset('assets/images/LogoFIs.png') }}" class="logo-large">
                    </a>
                </div>
            </div>

            <div class="sidebar-inner niceScrollleft">
                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Home</li>
                        <li>
                            <a href="{{ url('Dashboard.html') }}" class="waves-effect">
                                <i class="mdi mdi-airplay"></i>
                                <span> Dashboard <span class="badge badge-pill badge-primary float-right"></span></span>
                            </a>
                        </li>
                        <li class="menu-title">Fitur</li>
                        <li>
                            <a href="{{ url('Karyawan.html') }}" class="waves-effect"><i
                                    class="mdi mdi-account-multiple-plus"></i><span> Karyawan </span> <span
                                    class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti ti-receipt"></i><span>
                                    Transaksi </span> <span class="float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('Data Masuk.html') }}">Data Masuk</a></li>
                                <li><a href="{{ url('Data Keluar.html') }}">Data Keluar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('Produk.html') }}" class="waves-effect"><i class="ti ti-package"></i><span>
                                    Produk </span> <span class="float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect active"><i class="ti ti-book"></i><span>
                                    Modul </span> <span class="float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('admin.modul') }}">Modul</a></li>
                                <li><a href="{{ route('admin.tambah_modul') }}">Tambah Modul</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0 );" class="waves-effect"><i
                                    class="mdi mdi-calendar-multiple-check"></i><span> Daily Task </span> <span
                                    class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('Task.html') }}">Task</a></li>
                                <li><a href="{{ url('Tambah Task.html') }}">Tambah Task</a></li>
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
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-message"></i></div>
                                        <p class="notify-details"><b>Pesan Baru</b><small class="text-muted">Seseorang
                                                menambahkan data masuk</small></p>
                                    </a>
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
                                    <a class="dropdown-item" href="{{ url('Login.html') }}"><i
                                            class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
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

                <div class="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li class="breadcrumb-item"><a
                                                    href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="{{ route('admin.modul') }}">Modul</a>
                                            </li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Modul</h4>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="content">
                            @foreach ($moduls as $modul)
                                <div class="module-card">
                                    <img src="{{ asset('assets/images/Modul.jpg') }}" alt="Module Image"
                                        class="module-image">
                                    <div class="module-info">

                                        <h3>{{ $modul['judul'] ?? 'Judul tidak tersedia' }}</h3>
                                        <p>{{ $modul['deskripsi'] ?? 'Deskripsi tidak tersedia' }}</p>
                                    </div>
                                        <div class="actions">
                                            <button>Edit</button>

                                            <form id="deleteForm{{ $modul['id'] }}"
                                                action="{{ route('modul.destroy', $modul['id']) }}" method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirmDelete(event, {{ $modul['id'] }})">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="display: none;"
                                                    id="deleteButton{{ $modul['id'] }}">Hapus</button>
                                            
                                            <button onclick="openDeleteModal({{ $modul['id'] }})">Hapus</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            @endforeach

                            <div id="deleteModal" class="modal">
                                <div class="modal-content animate">
                                    <span class="close" onclick="closeDeleteModal()">&times;</span>
                                    <h2>Hapus Modul</h2>
                                    <p>Apakah Anda yakin ingin menghapus modul ini?</p>
                                    <button onclick="confirmDelete()">Hapus</button>
                                    <button onclick="closeDeleteModal()">Batal</button>
                                </div>
                            </div>
                        </div><!-- container -->
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

        <!-- Required datatable js -->
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
        <!-- Responsive examples -->
        <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ asset('assets/pages/datatables.init.js') }}"></script>
        <script src="{{ asset('assets/plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
        <script src="{{ asset('assets/plugins/tiny-editable/numeric-input-example.js') }}"></script>
        <script src="{{ asset('assets/plugins/tabledit/jquery.tabledit.js') }}"></script>
        <script src="{{ asset('assets/pages/tabledit.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <!--Modul-->
        <script src="{{ asset('assets/js/Modul.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('#datatable2').DataTable();
            });
        </script>
</body>

</html>