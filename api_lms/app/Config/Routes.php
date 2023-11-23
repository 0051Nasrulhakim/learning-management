<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// routes manual (auto route false)

$routes->group('siswa', static function ($routes) {
    $routes->get('get_all_siswa', 'Siswa::get_all_siswa');
    $routes->post('saveSiswa', 'Siswa::saveSiswa');
    $routes->get('nimOtomatis', 'Siswa::nimOtomatis');
});
$routes->group('tahun', static function ($routes) {
    $routes->get('get_all_tahun', 'Tahun::get_all_tahun');
    $routes->post('saveTahun', 'Tahun::saveTahun');
});
$routes->group('kelas', static function ($routes) {
    $routes->get('get_all_kelas', 'Kelas::get_all_kelas');
    $routes->post('saveKelas', 'Kelas::saveKelas');
    $routes->post('updateKelas', 'Kelas::updateKelas');
    $routes->post('kelas_w_jurusan', 'Kelas::kelas_w_jurusan');
});
$routes->group('jurusan', static function ($routes) {
    $routes->get('get_all_jurusan', 'Jurusan::get_all_jurusan');
    $routes->post('saveJurusan', 'Jurusan::saveJurusan');
    $routes->post('updateJurusan', 'Jurusan::updateJurusan');
    $routes->post('hapusJurusan', 'Jurusan::hapusJurusan');
    // $routes->post('singkatanJurusan', 'Jurusan::singkatanJurusan');
});

// selain post alihkan ke halaman 404

// $routes->get('/siswa/(:any)', 'Siswa::index');
// $routes->get('/jurusan/(:any)', 'Siswa::index');

// get method root
$routes->get('/', 'Siswa::index');
$routes->get('/', 'Jurusan::index');
$routes->get('/(:any)', 'Siswa::index');