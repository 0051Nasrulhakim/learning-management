<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestTrait;
use CodeIgniter\RESTful\ResourceController;

class Siswa extends ResourceController
{
    // 
    use RequestTrait;

    public function __construct()
    {
        // $this->siswa = model('App\Models\Siswa');
        $this->siswa = new \App\Models\Siswa;
    }

    public function index(){
        echo "Error 404 Not Found <br>";
        echo "URL INI TIDAK MENAMPILKAN HALAMAN WEB <br>";
        echo "Silahkan gunakan URL yang benar";
    }

    public function get_all_siswa()
    {
        
        $data = [
            'status' => 'Success',
            'datas'  => $this->siswa->select('siswa.*, kelas.kelas , jurusan.jurusan')
            ->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
            ->join('jurusan','jurusan.id_jurusan = kelas.id_jurusan')
            ->findAll()
        ];
        // dd($data);
        // return $this->respond($data, 401);
        return $this->response->setJSON($data);
    }

    public function saveSiswa(){
        $this->validation = \Config\Services::validation();

        $data = (array)$this->request->getJSON();

        if(!$this->validation->run($data, 'validate_siswa')){

            $data = [
                'status' => 'error',
                'message' => $this->validation->getErrors()
            ];

            return $this->response->setJSON($data);

        }else{
            $data = [
                'status' => 'success',
                'message' => 'Berhasil Menambahkan Siswa'
            ];
            return $this->response->setJSON($data);
        }
    }

    public function nimOtomatis(){
        $max_nis = $this->siswa->select("MAX(nis) as maxNis")->first();
        $max_nis = $max_nis['maxNis'] + 1;
        if($max_nis != null || $max_nis != '' || $max_nis != ""){
            $data = [
                'datas' => $max_nis
            ];
            return $this->response->setJSON($data);
        }
        $data = [
            'datas' => '19200'
        ];
        return $this->response->setJSON($data);
        // print_r($max_nis);
    }
}
    
