<?php

namespace App\Controllers;

// use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestTrait;
use CodeIgniter\RESTful\ResourceController;

class Jurusan extends ResourceController
{
    use RequestTrait;
    public function __construct()
    {
        // $this->siswa = model('App\Models\Siswa');
        $this->jurusan = new \App\Models\Jurusan;
    }

    public function index(){
        echo "Error 404 Not Found <br>";
        echo "URL INI TIDAK MENAMPILKAN HALAMAN WEB <br>";
        echo "Silahkan gunakan URL yang benar";
    }

    public function get_all_jurusan()
    {
        $data = [
            'status' => 'Success',
            'datas'  => $this->jurusan->findAll()
        ];
        // dd($data);
        // return $this->respond($data, 401);
        return $this->response->setJSON($data);
    }

    public function saveJurusan(){
        $this->validation = \Config\Services::validation();

        $data = (array)$this->request->getJSON();
        $jurusan = strtolower($data['jurusan']);
        $data = [
            'jurusan' => ucwords($jurusan),
            'singkatan' => strtoupper($data['singkatan'])
        ];

        if(!$this->validation->run($data, 'validate_jurusan')){
            $data = [
                'status' => 'error',
                'message' => $this->validation->getErrors()
            ];
            return $this->response->setJSON($data);
        }else{
            // $this->Pasien->insert($data);
            $data = [
                'status' => 'success',
                'message' => 'Data Jurusan berhasil ditambahkan'
            ];
            return $this->response->setJSON($data);
            // return $this->respond($data);
        }
    }

    public function updateJurusan(){
        $this->validation = \Config\Services::validation();
        
        $data = (array)$this->request->getJSON();
        $jurusan = strtolower($data['jurusan']);
        $data = [
            'id_jurusan'=> $data['id_jurusan'],
            'jurusan'   => ucwords($jurusan),
            'singkatan' => strtoupper($data['singkatan'])
        ];

        if(!$this->validation->run($data, 'validate_update_jurusan')){
            $data = [
                'status' => 'error',
                'message' => $this->validation->getErrors()
            ];
            return $this->response->setJSON($data);
        }else{
            // $this->Pasien->insert($data);
            $data = [
                'status'        => 'success',
                'new_data'      => [
                    'new_jurusan'   => $data['jurusan'],
                    'new_singkatan' => $data['singkatan']
                ],
                'message'       => 'Data Jurusan berhasil diubah'
            ];
            return $this->response->setJSON($data);
            // return $this->respond($data);
        }
    }

    public function hapusJurusan(){
        $data = (array)$this->request->getJSON();
        if($data != null || $data != ''){
            // $this->jurusan->delete($data['id_kelas'])
            $data = [
                'status'    => 'success',
                'message'   => 'Berhasil Menghapus Kelas '. $data['kelas']
            ];
            return $this->response->setJSON($data);
        }else{
            $data = [
                'status'    => 'error',
                'message'   => 'Gagal Menghapus Kelas. Pastikan memilih jurusan yang akan di hapus'
            ];
            return $this->response->setJSON($data);
        }
    }

}
