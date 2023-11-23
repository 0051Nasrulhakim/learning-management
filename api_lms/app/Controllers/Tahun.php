<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestTrait;
use CodeIgniter\RESTful\ResourceController;

class Tahun extends ResourceController
{
    // 
    use RequestTrait;

    public function __construct()
    {
        // $this->siswa = model('App\Models\Siswa');
        $this->tahun = new \App\Models\Tahun;
        
    }

    public function index(){
        echo "Error 404 Not Found <br>";
        echo "URL INI TIDAK MENAMPILKAN HALAMAN WEB <br>";
        echo "Silahkan gunakan URL yang benar";
    }

    public function get_all_tahun()
    {
        $data = [
            'status' => 'Success',
            'datas'  => $this->tahun->findAll()
        ];
        // return $this->respond($data, 401);
        return $this->response->setJSON($data);
    }

    public function saveTahun(){
        $this->validation = \Config\Services::validation();

        $data = (array)$this->request->getJSON();

        if(!$this->validation->run($data, 'validate_tahun')){

            $data = [
                'status' => 'error',
                'message' => $this->validation->getErrors()
            ];

            return $this->response->setJSON($data);

        }else{
            $tahun_mulai = date('y', strtotime($data['tahun_mulai']));
            $tahun_selesai = date('y', strtotime($data['tahun_selesai']));
            
            if($tahun_mulai == $tahun_selesai && $data['semester'] == '1'){
                $tahun_selesai = $tahun_selesai + 1;
            }else if($tahun_mulai == $tahun_selesai && $data['semester'] == '2'){
                $tahun_mulai = $tahun_mulai - 1; 
            }

            $id = $tahun_mulai.$tahun_selesai.$data['semester'];

            $cek_id = $this->tahun->find($id);
            if($cek_id != null || $cek_id != ''){
                $res = [
                    'status' => '409',
                    'message' => 'Tahun Yang Ditambahkan Sudah Ada Didalam Database'
                ];
                
                return $this->response->setJSON($res);
            }

            if($data['tahun_mulai'] >= $data['tahun_selesai']){
                $res = [
                    'status' => '409',
                    'message' => 'Tahun Selesai Tidak Boleh lebih Besar dari Tahun Mulai'
                ];
                
                return $this->response->setJSON($res);
            }

            $save_data = [
                'id'            => $id,
                'tahun_mulai'   => $data['tahun_mulai'],
                'semester'      => $data['semester'],
                'tahun_selesai' => $data['tahun_selesai']
            ];
            // save tahun
            $this->tahun->insert($save_data);
            $res = [
                'status' => 'success',
                'message' => 'Data Tahun Ajaran berhasil ditambahkan'
            ];

            return $this->response->setJSON($res);
        }
    }



}

?>