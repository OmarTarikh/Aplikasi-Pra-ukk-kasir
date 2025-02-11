
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Kasir</title>
    <link rel="icon" href="{{ asset('image/logo-twh.png') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQJQ9lV5m26RrSAwPLkEoIoNYMpZUbZlhFLkDAqAj6K4BEm2mB2n5B5z4" crossorigin="anonymous">

    <!-- Custom fonts for this template -->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('image/logo-twh.png') }}" alt="Logo" width="45" height="45">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Tabel Kasir</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tabel-tabel Kasir :</h6>
                        <a class="collapse-item" href="{{ route('pelanggan.index') }}">Tabel Pelanggan</a>
                        <a class="collapse-item" href="{{ route('penjualan.index') }}">Tabel Penjualan</a>
                        <a class="collapse-item" href="{{ route('produk.index') }}">Tabel Produk</a>
                        <a class="collapse-item" href="{{ route('detailpenjualan.index') }}">Tabel Detail Penjualan</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Tabel Users</span></a>
            </li>            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->name }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                    <path fill="#d5d5d5" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4"/>
                                </svg>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Data Detail Penjualan</h6>
                                <div>                            
                                    <a href="#" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#addDetailPenjualanModal">
                                        Tambah Detail Penjualan
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="#fff" d="M7.007 12a.75.75 0 0 1 .75-.75h3.493V7.757a.75.75 0 0 1 1.5 0v3.493h3.493a.75.75 0 1 1 0 1.5H12.75v3.493a.75.75 0 0 1-1.5 0V12.75H7.757a.75.75 0 0 1-.75-.75"/>
                                            <path fill="#fff" fill-rule="evenodd" d="M7.317 3.769a42.5 42.5 0 0 1 9.366 0c1.827.204 3.302 1.643 3.516 3.48c.37 3.157.37 6.346 0 9.503c-.215 1.837-1.69 3.275-3.516 3.48a42.5 42.5 0 0 1-9.366 0c-1.827-.205-3.302-1.643-3.516-3.48a41 41 0 0 1 0-9.503c.214-1.837 1.69-3.276 3.516-3.48m9.2 1.49a41 41 0 0 0-9.034 0A2.486 2.486 0 0 0 5.29 7.424a39.4 39.4 0 0 0 0 9.154a2.486 2.486 0 0 0 2.193 2.164c2.977.332 6.057.332 9.034 0a2.486 2.486 0 0 0 2.192-2.164a39.4 39.4 0 0 0 0-9.154a2.486 2.486 0 0 0-2.192-2.163" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('detailpenjualan.export-pdf') }}" class="btn btn-md btn-danger">
                                        Export to PDF
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="#fff" d="M13.586 2a2 2 0 0 1 1.284.467l.13.119L19.414 7a2 2 0 0 1 .578 1.238l.008.176V20a2 2 0 0 1-1.85 1.995L18 22H6a2 2 0 0 1-1.995-1.85L4 20V4a2 2 0 0 1 1.85-1.995L6 2zM12 4H6v16h12V10h-4.5a1.5 1.5 0 0 1-1.493-1.356L12 8.5zm.988 7.848a6.22 6.22 0 0 0 2.235 3.872c.887.717.076 2.121-.988 1.712a6.22 6.22 0 0 0-4.47 0c-1.065.41-1.876-.995-.989-1.712a6.22 6.22 0 0 0 2.235-3.872c.178-1.127 1.8-1.126 1.977 0m-.99 2.304l-.688 1.196h1.38zM14 4.414V8h3.586z"/></g></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>ID Detail</th>
                                            <th>ID Penjualan</th>
                                            <th>Produk</th>
                                            <th>Jumlah Produk</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($detailpenjualan as $dp)
                                        <tr>
                                            <td>{{ $loop->iteration }}.</td>
                                            <td>{{ $dp->DetailID }}</td>
                                            <td>{{ $dp->penjualan->PenjualanID }}</td>
                                            <td>{{ $dp->produk->NamaProduk }}</td>
                                            <td>{{ $dp->JumlahProduk }}</td>
                                            <td>Rp {{ number_format($dp->Subtotal, 2, ',', '.') }}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('detailpenjualan.destroy', $dp->DetailID) }}" method="POST">
                                                    <!-- SHOW BUTTON -->
                                                    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#showDetailPenjualanModal{{ $dp->DetailID }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#fff" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
                                                    </button>
                    
                                                    <!-- EDIT BUTTON -->
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editDetailPenjualanModal{{ $dp->DetailID }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></g></svg>
                                                    </button>
                    
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#fff" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z"/></svg></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <div class="alert alert-danger">Data Detail Penjualan belum tersedia.</div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    @foreach ($detailpenjualan as $dp)
                    <!-- SHOW DetailPenjualan Modal -->
                    <div class="modal fade" id="showDetailPenjualanModal{{ $dp->DetailID }}" tabindex="-1" aria-labelledby="showDetailPenjualanLabel{{ $dp->DetailID }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showDetailPenjualanLabel{{ $dp->DetailID }}">Detail Penjualan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border: none; background: none; color: gray; font-size: 20px;">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>ID Penjualan:</strong> {{ $dp->penjualan->PenjualanID }}</p>
                                    <p><strong>Produk:</strong> {{ $dp->produk->NamaProduk }}</p>
                                    <p><strong>Jumlah Produk:</strong> {{ $dp->JumlahProduk }}</p>
                                    <p><strong>Subtotal:</strong> Rp {{ number_format($dp->Subtotal, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- EDIT DetailPenjualan Modal -->
                    <div class="modal fade" id="editDetailPenjualanModal{{ $dp->DetailID }}" tabindex="-1" aria-labelledby="editDetailPenjualanLabel{{ $dp->DetailID }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editDetailPenjualanLabel{{ $dp->DetailID }}">Edit Detail Penjualan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border: none; background: none; color: gray; font-size: 20px;">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('detailpenjualan.update', $dp->DetailID) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                    
                                        <div class="mb-3">
                                            <label for="PenjualanID{{ $dp->DetailID }}" class="form-label">Penjualan</label>
                                            <select class="form-select" id="PenjualanID{{ $dp->DetailID }}" name="PenjualanID" required>
                                                @foreach ($penjualan as $p)
                                                    <option value="{{ $p->PenjualanID }}" {{ $dp->PenjualanID == $p->PenjualanID ? 'selected' : '' }}>
                                                        {{ $p->PenjualanID }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                    
                                        <div class="mb-3">
                                            <label for="ProdukID{{ $dp->DetailID }}" class="form-label">Produk</label>
                                            <select class="form-select" id="ProdukID{{ $dp->DetailID }}" name="ProdukID" required>
                                                @foreach ($produk as $prod)
                                                    <option value="{{ $prod->ProdukID }}" {{ $dp->ProdukID == $prod->ProdukID ? 'selected' : '' }}>
                                                        {{ $prod->NamaProduk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                    
                                        <div class="mb-3">
                                            <label for="JumlahProduk{{ $dp->DetailID }}" class="form-label">Jumlah Produk</label>
                                            <input type="number" class="form-control" id="JumlahProduk{{ $dp->DetailID }}" name="JumlahProduk" value="{{ $dp->JumlahProduk }}" required>
                                        </div>
                    
                                        <div class="mb-3">
                                            <label for="Subtotal{{ $dp->DetailID }}" class="form-label">Subtotal</label>
                                            <input type="number" class="form-control" id="Subtotal{{ $dp->DetailID }}" name="Subtotal" value="{{ $dp->Subtotal }}" required>
                                        </div>
                    
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    <!-- Tambah Detail Penjualan Modal -->
                    <div class="modal fade" id="addDetailPenjualanModal" tabindex="-1" aria-labelledby="addDetailPenjualanLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addDetailPenjualanLabel">Tambah Detail Penjualan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border: none; background: none; color: gray; font-size: 20px;">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form to add detail penjualan -->
                                    <form action="{{ route('detailpenjualan.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="PenjualanID" class="form-label">Pilih Penjualan</label>
                                            <select class="form-select" id="PenjualanID" name="PenjualanID" required>
                                                <option value="" disabled selected>Pilih Penjualan</option>
                                                @foreach ($penjualan as $pj)
                                                    <option value="{{ $pj->PenjualanID }}">{{ $pj->PenjualanID }} - {{ $pj->TanggalPenjualan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ProdukID" class="form-label">Pilih Produk</label>
                                            <select class="form-select" id="ProdukID" name="ProdukID" required>
                                                <option value="" disabled selected>Pilih Produk</option>
                                                @foreach ($produk as $p)
                                                    <option value="{{ $p->ProdukID }}">{{ $p->NamaProduk }} - Rp {{ number_format($p->Harga, 2, ',', '.') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="JumlahProduk" class="form-label">Jumlah Produk</label>
                                            <input type="number" class="form-control" id="JumlahProduk" name="JumlahProduk" min="1" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Subtotal" class="form-label">Subtotal</label>
                                            <input type="number" class="form-control" id="Subtotal" name="Subtotal" readonly>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Aleser T.O 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let jumlahProdukInput = document.getElementById('JumlahProduk');
            let produkSelect = document.getElementById('ProdukID');
            let subtotalInput = document.getElementById('Subtotal');
            let hargaProduk = @json($produk->pluck('Harga', 'ProdukID')); 
            let stokProduk = @json($produk->pluck('Stok', 'ProdukID')); 
    
            function updateSubtotal() {
                let selectedProduct = produkSelect.value;
                let jumlahProduk = jumlahProdukInput.value || 1;
                
                if (selectedProduct && stokProduk[selectedProduct] !== undefined) {
                    if (jumlahProduk > stokProduk[selectedProduct]) {
                        alert(`Stok tidak mencukupi! Stok tersedia: ${stokProduk[selectedProduct]}`);
                        jumlahProdukInput.value = stokProduk[selectedProduct];
                    }
                    subtotalInput.value = hargaProduk[selectedProduct] * jumlahProdukInput.value;
                }
            }
    
            produkSelect.addEventListener('change', updateSubtotal);
            jumlahProdukInput.addEventListener('input', updateSubtotal);
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

</body>

</html>