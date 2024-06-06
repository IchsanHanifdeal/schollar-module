@include('lecturer.layout.header')
@yield('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1 class="m-0">Welcome to {{ ucfirst(config('app.name')) }} {{ ucfirst(session('name')) }}</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-12 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <h3>{{ date('H:i') }}</h3>

                                                <p>Pukul</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>{{ $jumlah_pembelajaran }}</h3>

                                                <p>Pembelajaran</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-book"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>{{ $jumlah_materi }}</h3>

                                                <p>Materi</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-folder"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>{{ $jumlah_mahasiswa }}</h3>

                                                <p>Mahasiswa</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>{{ $jumlah_absensi }}</h3>

                                                <p>Absensi</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-table"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>{{ $jumlah_tugas }}</h3>

                                                <p>Tugas</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-tasks"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>{{ $jumlah_nilai }}</h3>

                                                <p>Nilai</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-book-reader"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('lecturer.layout.footer')
