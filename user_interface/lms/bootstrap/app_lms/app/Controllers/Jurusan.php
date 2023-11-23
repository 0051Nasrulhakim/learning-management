<?php

namespace App\Controllers;
use GuzzleHttp\Client;
class Jurusan extends BaseController
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
    public function daftar_jurusan()
    {
        $res = $this->client->request('GET', 'http://localhost:1000/jurusan/get_all_jurusan');
        $data = json_decode($res->getBody()->getContents(), true);
    
        return view('role/admin/jurusan', $data);
    }

    public function insertJurusan(){

        $res = $this->client->request('POST', 'http://localhost:1000/jurusan/saveJurusan', [
            'json' => [
                'jurusan'   => $this->request->getPost('jurusan'),
                'singkatan' => $this->request->getPost('singkatan')
            ]
        ]);

        $res = json_decode($res->getBody(), true);

        if($res['status'] == 'error'){
            session()->setFlashdata('error', $res['message']);
            return redirect()->back()->withInput();
        }
        
        return redirect()->to(base_url().'jurusan/daftar_jurusan')->with('success', $res['message']);
    }

    public function editJurusan(){

        $old_jurusan = $this->request->getPost('old_jurusan');
        $old_singkatan = $this->request->getPost('old_singkatan');

        $res = $this->client->request('POST', 'http://localhost:1000/jurusan/updateJurusan', [
            'json' => [
                'id_jurusan'=> $this->request->getPost('id_jurusan'),
                'jurusan'   => $this->request->getPost('jurusan'),
                'singkatan' => $this->request->getPost('singkatan')
            ]
        ]);

        $res = json_decode($res->getBody(), true);

        if($res['new_data']['new_jurusan'] != $old_jurusan && $res['new_data']['new_singkatan'] != $old_singkatan){
            return redirect()->to(base_url().'jurusan/daftar_jurusan')->with('success', 'Berhasil mengubah jurusan '.$old_jurusan.' Menjadi Jurusan ' .$res['new_data']['new_jurusan']. ' Dan mengubah singkatan '.$old_singkatan.' Menjadi singkatan ' .$res['new_data']['new_singkatan']);
        }else if($res['new_data']['new_jurusan'] != $old_jurusan){
            return redirect()->to(base_url().'jurusan/daftar_jurusan')->with('success', 'Berhasil mengubah jurusan '.$old_jurusan.' Menjadi Jurusan ' .$res['new_data']['new_jurusan']);
        }else if($res['new_data']['new_singkatan'] != $old_singkatan){
            return redirect()->to(base_url().'jurusan/daftar_jurusan')->with('success', 'Berhasil mengubah singkatan '.$old_singkatan.' Menjadi singkatan ' .$res['new_data']['new_singkatan']);
        }

    }
    
    public function hapusJurusan($id_jurusan, $jurusan){
        $res = $this->client->request('POST', 'http://localhost:1000/jurusan/hapusJurusan', [
            'json' => [
                'id_jurusan'=> $id_jurusan,
                'jurusan'   => $jurusan
            ]
        ]);
        $res = json_decode($res->getBody(), true);
        // dd($res);
        if($res['status'] == 'success'){
            return redirect()->to(base_url().'jurusan/daftar_jurusan')->with('success', $res['message']);
        }else{
            return redirect()->to(base_url().'jurusan/daftar_jurusan')->with('success', $res['message']);
        }
    }
}
