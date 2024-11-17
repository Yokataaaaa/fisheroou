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
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

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

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i
                                    class="mdi mdi-calendar-multiple-check"></i><span> Daily Task </span> <span
                                    class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('admin.task') }}">Task</a></li>
                                <li><a href="{{ route('admin.tambah_task') }}">Tambah Task</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->
        <div class="content-page">
            <div class="container">
                <h1>Edit Produk</h1>

                {{-- Menampilkan pesan error atau sukses --}}
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form untuk mengedit produk --}}
                <form action="{{ route('admin.produk.update', $produk['id']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_kolam">Nama Kolam</label>
                        <input type="text" class="form-control" id="nama_kolam" name="nama_kolam"
                            value="{{ old('nama_kolam', $produk['nama_kolam']) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $produk['deskripsi']) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                            value="{{ old('jenis_kelamin', $produk['jenis_kelamin']) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="total_ikan">Total Ikan</label>
                        <input type="number" class="form-control" id="total_ikan" name="total_ikan"
                            value="{{ old('total_ikan', $produk['total_ikan']) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="total_pakan">Total Pakan</label>
                        <input type="number" class="form-control" id="total_pakan" name="total_pakan"
                            value="{{ old('total_pakan', $produk['total_pakan']) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui Produk</button>
                </form>

                {{-- Tombol kembali ke daftar produk --}}
                <a href="{{ route('admin.produk') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Produk</a>
            </div>
        </div>

        <footer class="footer">
            © 2024 FisheerLog by Fisheero.
        </footer>

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function () {
            // Inisialisasi DataTable pada tabel dengan id 'datatable2'
            $('#datatable2').DataTable();
        });
    </script>



</body>

</html>
