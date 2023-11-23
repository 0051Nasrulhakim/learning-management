<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS - ADMIN SMKN 1 Cikarang Selatan</title>
    <link rel="stylesheet" href="<?= base_url()?>/assets/css/style-admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
<div class="container-section">


    <div class="wrapper-page">
        <!-- testing -->
        <div class="sidebar">
            <div class="foto">
                <div class="foto-section text-center">
                    <i class="fa-solid fa-user fa-5x" style="margin-top: 20%;"></i>
                    <br><strong> ADMIN </strong>
                </div>
                <div class="menu" style="padding-top: 4%; margin-left: -1%;">
                    <div class="list-menu">
                        <ul>
                            <li><a href="">......</a></li>
                            <li><a href="<?= base_url()?>tahun/tahun_ajaran"><i class="fa-solid fa-calendar-check"></i>TAHUN AJARAN</a></li>
                            <div class="siswa " id="siswa">
                                <li style="display: flex;" onclick="siswa()">
                                    <div class="text" style="width: 92%;">
                                        <!-- <i class="fa-solid fa-book"></i>siswa -->
                                        <i class="fa-solid fa-user"></i>SISWA
                                    </div>
                                    <div class="panah">
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </li>
                                <div class="sub-menu" style="margin-left: 10%;">
                                    <li><a href="<?= base_url()?>siswa/daftar_siswa"><i class="fa-solid fa-users"></i>DAFTAR SISWA</a></li>
                                    <li><a href=""><i class="fa-solid fa-user-check"></i>PRESENSI</a></li>
                                    <!-- <li><a href="">Kehadiran Kuliah</a></li> -->
                                </div>
                            </div>
                            <div class="ujian " id="ujian">
                                <li style="display: flex;" onclick="ujian()">
                                    <div class="text" style="width: 92%;">
                                        <i class="fa-solid fa-book-journal-whills"></i>Ujian dan Nilai
                                    </div>
                                    <div class="panah">
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </li>
                                <div class="sub-menu" style="margin-left: 10%;">
                                    <li><a href=""><i class="fa-solid fa-list-check"></i>NILAI TUGAS</a></li>
                                    <li><a href=""><i class="fa-solid fa-calendar-days"></i>NILAI UTS</a></li>
                                    <li><a href=""><i class="fa-solid fa-list-ol"></i>Nilai UAS</a></li>
                                </div>
                            </div>
                            <div class="jadwal " id="jadwal">
                                <li style="display: flex;" onclick="jadwal()">
                                    <div class="text" style="width: 92%;">
                                        <i class="fa-solid fa-calendar-day"></i>Jadwal
                                    </div>
                                    <div class="panah">
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </li>
                                <div class="sub-menu" style="margin-left: 10%;">
                                    <li><a href=""><i class="fa-solid fa-calendar-days"></i>Jadwal Ujian</a></li>
                                    <li><a href=""><i class="fa-solid fa-table-list"></i>Jadwal Pelajaran</a></li>
                                </div>
                            </div>
                            <li><a href=""><i class="fa-solid fa-user-tie"></i></i>GURU & STAFF</a></li>
                            <li><a href="<?= base_url()?>jurusan/daftar_jurusan"><i class="fa-solid fa-wallet"></i>JURUSAN</a></li>
                            <li><a href="<?= base_url()?>kelas/daftar_kelas"><i class="fa-solid fa-building-user"></i>KELAS</a></li>
                            <li><a href=""><i class="fa-solid fa-wallet"></i>Keuangan</a></li>
                            <li><a href=""><i class="fa-solid fa-comments"></i>DAFTAR PERTANYAAN</a></li>
                            <div class="surat " id="surat">
                                <li style="display: flex;" id="menu" onclick="surat()">
                                    <div class="text" style="width: 92%;">
                                        <i class="fa-solid fa-envelope"></i>Surat Menyurat
                                    </div>
                                    <div class="panah">
                                        <i class="fa-solid fa-sort-down"></i>
                                    </div>
                                </li>
                                <div class="sub-menu" style="margin-left: 10%;">
                                    <li><a href=""><i class="fa-solid fa-envelope-open-text"></i>BUAT SURAT</a></li>
                                    <li><a href=""><i class="fa-solid fa-envelope-circle-check"></i>PENGAJUAN</a></li>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page">
            <div class="name-app">
                <div class="text-1">
                    SMK NEGERI 1 CIKARANG SELATAN
                </div>
                <div class="text-2">
                    ADMIN - LEARNING MANAGEMENT SISTEM
                </div>
            </div>
            <div class="top-bar">
                <div class="alert alert-secondary" role="alert">
                    <div class="left">
                        <nav style="--bs-breadcrumb-divider: '->';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" style="text-decoration: none;"><i class="fa-solid fa-house"></i><strong> Home</strong></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Library</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="right">
                        <div class="text">
                            senin, 12-okt-2023 / 14:00:01 WIB <button class="btn btn-sm btn-danger" style="margin-top: -1%;">
                                Logout
                            </button>
                        </div>
                        <div class="log-out">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="user">
                    <div class="sapaan">
                        Halo selamat pagi
                    </div>
                    <div class="pemisah">
                        :
                    </div>
                    <div class="nama" style="margin-right: 0.5%;">
                        ADMIN
                    </div>
                </div>