<?php

namespace App\Controllers;
use GuzzleHttp\Client;
class Kelas extends BaseController
{
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:1000/',
            // You can set any number of default request options.
            // 'timeout'  => 2.0,
        ]);
    }

    public function index()
    {

    }
    public function daftar_kelas()
    {
        $res = $this->client->request('GET', 'http://localhost:1000/kelas/get_all_kelas');
        $data = json_decode($res->getBody()->getContents(), true);
        // dd($data);
        return view('role/admin/kelas', $data);
    }

    public function insertKelas(){
        $tingkat_kelas = $this->request->getPost('tingkatanKelas');
        $rombel = $this->request->getPost('rombel');
        $id_jurusan = $this->request->getPost('jurusan');

        // $data = [
        //     // 'id_kelas'       => 
        //     'tingkatanKelas' => $tingkat_kelas,
        //     'rombel'         => $rombel,
        //     'id_jurusan'     => $id_jurusan,
        //     'old_tingkat_kelas' => $this->request->getPost('old_tingkat_kelas'),
        //     'old_rombel'        => $this->request->getPost('old_rombel'),
        //     'old_jurusan'       => $this->request->getPost('old_jurusan'),
        // ];
        // dd($data);

        $res = $this->client->request('POST', 'http://localhost:1000/kelas/saveKelas', [
            'json' => [
                'tingkat_kelas' => $tingkat_kelas,
                'rombel'        => $rombel,
                'id_jurusan'    => $id_jurusan
            ]
        ]);

        $res = json_decode($res->getBody(), true);
        // dd($res);
        if($res['status'] == 'error'){
            session()->setFlashdata('error', $res['message']);
            return redirect()->back()->withInput();
        }else if($res['status'] == '404' || $res['status'] == '409'){
            session()->setFlashdata('failed', $res['message']);
            return redirect()->back()->withInput();
        }
        
        return redirect()->to(base_url().'kelas/daftar_kelas')->with('success', $res['message']);
    }

    public function editKelas(){
        $tingkat_kelas = $this->request->getPost('tingkatanKelas');
        $rombel = $this->request->getPost('rombel');
        $id_jurusan = $this->request->getPost('jurusan');

        $old_jurusan = $this->request->getPost('old_jurusan');
        $old_singkatan = $this->request->getPost('old_singkatan');

        $res = $this->client->request('POST', 'http://localhost:1000/kelas/updateKelas', [
            'json' => [
                'id_kelas'      => $this->request->getPost('id_kelas'),
                'tingkat_kelas' => $tingkat_kelas,
                'rombel'        => $rombel,
                'id_jurusan'    => $id_jurusan
            ]
        ]);

        $res = json_decode($res->getBody(), true);

        if($res['status'] == '404' || $res['status'] == '409'){

            // return redirect()->to(base_url().'kelas/daftar_kelas')->with('failed', $res['message']);
            session()->setFlashdata('failed', $res['message']);
            return redirect()->back()->withInput();

        }else if($res['status'] == 'error'){

            session()->setFlashdata('error', $res['message']);
            return redirect()->back()->withInput();

        }else{
            return redirect()->to(base_url().'kelas/daftar_kelas')->with('success', $res['message']);
        }

    }

    //
    public function hapusKelas($id_kelas, $kelas){
        $res = $this->client->request('POST', 'http://localhost:1000/jurusan/hapusJurusan', [
            'json' => [
                'id_kelas'=> $id_kelas,
                'kelas'   => $kelas
            ]
        ]);
        $res = json_decode($res->getBody(), true);
        // dd($res);
        if($res['status'] == 'success'){
            return redirect()->to(base_url().'kelas/daftar_kelas')->with('success', $res['message']);
        }else{
            return redirect()->to(base_url().'kelas/daftar_kelas')->with('success', $res['message']);
        }
    }

    public function kelas_w_jurusan(){
        $id_jurusan = $this->request->getPost('jurusan');
        $res = $this->client->request('POST', 'http://localhost:1000/kelas/kelas_w_jurusan', [
            'json' => [
                'id_jurusan'=> $id_jurusan
            ]
        ]);
        
        $res = json_decode($res->getBody(), true);
        $res = json_encode($res['datas']);
        return $this->response->setJSON($res);
        // echo $res;
    }
}
