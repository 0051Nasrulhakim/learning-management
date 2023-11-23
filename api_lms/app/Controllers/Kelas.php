<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Commands\Utilities\Publish;
use CodeIgniter\HTTP\RequestTrait;
use CodeIgniter\RESTful\ResourceController;

class Kelas extends ResourceController
{
    use RequestTrait;

    public function __construct()
    {
        // $this->siswa = model('App\Models\Siswa');
        $this->kelas = new \App\Models\Kelas;
        $this->jurusan = new \App\Models\Jurusan;
    }

    public function index(){
        echo "Error 404 Not Found <br>";
        echo "URL INI TIDAK MENAMPILKAN HALAMAN WEB <br>";
        echo "Silahkan gunakan URL yang benar";
    }

    public function get_all_kelas()
    {
        $data = [
            'status' => 'Success',
            'datas'  => [
                'kelas' => $this->kelas->select('kelas.id_kelas, kelas.kelas,kelas.id_jurusan, jurusan.jurusan, kelas.keterangan, ')
                            ->join('jurusan','jurusan.id_jurusan = kelas.id_jurusan')
                            ->findAll(),
                'jurusan'=> $this->jurusan->findAll()
            ]
        ];
        // return $this->respond($data, 401);
        return $this->response->setJSON($data);
    }

    public function saveKelas(){
        $this->validation = \Config\Services::validation();

        $data = (array)$this->request->getJSON();

        if(!$this->validation->run($data, 'validate_kelas')){

            $data = [
                'status' => 'error',
                'message' => $this->validation->getErrors()
            ];

            return $this->response->setJSON($data);

        }else{

            //cek apakah jurusan ada
            $jurusan = $this->jurusan->find($data['id_jurusan']);
            if($jurusan != '' || $jurusan != null){

                $data = [
                    'id_kelas'  => $data['tingkat_kelas'].$data['id_jurusan'].$data['rombel'],
                    'id_jurusan'=> $data['id_jurusan'],
                    'kelas'     => $data['tingkat_kelas']. ' ' .$jurusan['singkatan']. ' '. $data['rombel'],
                    'keterangan'     => $data['tingkat_kelas']. ' ' .$jurusan['jurusan']. ' '. $data['rombel'],
                ];

                //cek apakah kelas sudah ada
                $cek_id = $this->kelas->find($data['id_kelas']);
                if($cek_id == null || $cek_id == ''){

                    // insert data
                    // $this->kelas->insert($data);
                    $res = [
                        'status' => 'success',
                        'message' => 'Data Kelas berhasil ditambahkan'
                    ];

                    return $this->response->setJSON($res);

                }else{
                    $res = [
                        'status' => '409',
                        'message' => 'DATA KELAS YANG ANDA TAMBAHKAN SUDAH ADA.!!'
                    ];
                    
                    return $this->response->setJSON($res);
                }     

            }else{

                $res = [
                    'status' => '404',
                    'message' => 'DATA JURUSAN TIDAK DI TEMUKAN. PASTIKAN MENGINPUT JURUSAN DENGAN BENAR / JIKA BELUM ADA JURUSAN SILAHKAN INPUT JURUSAN TERLEBIH DAHULU'
                ];
                
                return $this->response->setJSON($res);
            }
        }
    }

    Public function updateKelas(){
        $this->validation = \Config\Services::validation();

        $data = (array)$this->request->getJSON();
        $id_kelas = $data['id_kelas'];

        $cek = $this->kelas->find($id_kelas);
        
        // cek apakah kelas ada
        if($cek != null || $cek != ''){
            
            if(!$this->validation->run($data, 'validate_kelas')){

                $data = [
                    'status' => 'error',
                    'message' => $this->validation->getErrors()
                ];
    
                return $this->response->setJSON($data);
            }

            //cek apakah jurusan ada
            $jurusan = $this->jurusan->find($data['id_jurusan']);
            if($jurusan != '' || $jurusan != null){

                $data = [
                    'id_kelas'  => $data['tingkat_kelas'].$data['id_jurusan'].$data['rombel'],
                    'id_jurusan'=> $data['id_jurusan'],
                    'kelas'     => $data['tingkat_kelas']. ' ' .$jurusan['singkatan']. ' '. $data['rombel'],
                    'keterangan'     => $data['tingkat_kelas']. ' ' .$jurusan['jurusan']. ' '. $data['rombel'],
                ];

                // cek apakah data yang akan di update memiliki duplikat id
                $cek = $this->kelas->find($data['id_kelas']);
                if($id_kelas != $data['id_kelas'] && $cek == null ) {

                    // $this->kelas->update($id_kelas, $data);

                    $res = [
                        'status' => 'success',
                        'message' => 'Data Kelas berhasil Diubah'
                    ];
    
                    return $this->response->setJSON($res);
                }

                $res = [
                    'status' => '409',
                    'message' => 'DATA KELAS YANG DIMAKSUD SUDAH ADA.!!'
                ];
                
                return $this->response->setJSON($res);
                
            }

            $res = [
                'status' => '404',
                'message' => 'DATA JURUSAN TIDAK DI TEMUKAN. PASTIKAN MENGINPUT JURUSAN DENGAN BENAR / JIKA BELUM ADA JURUSAN SILAHKAN INPUT JURUSAN TERLEBIH DAHULU'
            ];
            
            return $this->response->setJSON($res);


        }else{
            $res = [
                'status' => '409',
                'message' => 'DATA KELAS YANG ANDA UPDATE TIDAK DITEMUKAN.!!'
            ];
            
            return $this->response->setJSON($res);
        }
    }

    public function hapusJurusan(){
        $data = (array)$this->request->getJSON();
        if($data != null || $data != ''){
            // $this->jurusan->delete()
            $data = [
                'status'    => 'success',
                'message'   => 'Berhasil Menghapus Kelas'
            ];
            
            return $this->response->setJSON($data);
        }else{
            $data = [
                'status'    => 'error',
                'message'   => 'Gagal Menghapus Jurusan. Pastikan memilih jurusan yang akan di hapus'
            ];
            return $this->response->setJSON($data);
        }
    }

    public function kelas_w_jurusan(){
        $data = (array)$this->request->getJSON();
        // print_r($data);
        if($data != null || $data != '' || $data != ""){
            $res = $this->kelas->where('id_jurusan', $data['id_jurusan'])->select('kelas, id_kelas')->findAll();
            $data = [
                'datas' => $res
            ];
            return $this->response->setJSON($data);
        }

        $data = [
            'datas' => 'null'
        ];
        return $this->response->setJSON($data);

    }

}
