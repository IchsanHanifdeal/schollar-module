<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
        .gradient-custom {
            background: #7286D3;

            background: -webkit-linear-gradient(to right, 160deg, rgba(0, 147, 233, 1) 0%, rgba(128, 208, 199, 1) 100%);

            background: linear-gradient(to right, 160deg, rgba(0, 147, 233, 1) 0%, rgba(128, 208, 199, 1) 100%);
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="navbar navbar-expand-lg navbar-dark gradient-custom">
        <div class="container-fluid">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo d-inline-block align-text-top"
                    width="45" height="45">
            </a>
            <a class="navbar-brand" href="#">{{ config('app.name') }}</a>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse">
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </div>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark ml-auto" style="background-color:#8EA7E9">
            <div class="container">
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ $active === 'dashboard' ? ' active' : '' }}"
                                href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $active === 'pembelajaran' ? ' active' : '' }}"
                                href="{{ route('pembelajaran') }}"><i class="fas fa-book"></i> Pembelajaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $active === 'materi' ? ' active' : '' }}"
                                href="{{ route('materi') }}"><i class="fas fa-folder"></i> Materi</a>
                        </li>
                        @if ($role === 'dosen')
                            <li class="nav-item">
                                <a class="nav-link {{ $active === 'mahasiswa' ? ' active' : '' }}"
                                    href="{{ route('mahasiswa') }}"><i class="fas fa-users"></i> Mahasiswa</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ $active === 'absensi' ? ' active' : '' }}"
                                href="{{ route('absensi') }}"><i class="fas fa-table"></i> Absensi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $active === 'tugas' ? ' active' : '' }}"
                                href="{{ route('rekap_tugas') }}"><i class="fas fa-tasks"></i> Tugas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $active === 'nilai' ? ' active' : '' }}"
                                href="{{ route('nilai') }}"><i class="fas fa-book-reader"></i> Nilai</a>
                        </li>
                    </ul>

                    <!-- Right navbar links -->
                    <ul class="order-1 order-md-3 navbar-nav ml-auto">
                        {{-- <li class="nav-item me-2 me-lg-0">
                            <a class="nav-link {{ $active === 'profile' ? 'active' : '' }}"
                                href="{{ route('lecture.profile') }}"><i class="fas fa-user"></i> Profile</a>
                        </li> --}}
                        <li class="nav-item me-2 me-lg-0 label label-danger">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a href="#" class="nav-link btn btn-danger text-light"
                                    onclick="event.preventDefault(); confirmLogout();">
                                    <i class="nav-icon fas fa-power-off"></i>
                                    Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
