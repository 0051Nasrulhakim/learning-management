<?php

namespace App\Controllers;
use GuzzleHttp\Client;
class Tahun extends BaseController
{
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:1000/',
            // You can set any number of default request options.
            // 'timeout'  => 2.0,
        ]);
        helper(['tahun']);
    }

    public function index()
    {
        // return view('role/admin/dashboard');
        echo "Belum ada halaman";
    }

    public function tahun_ajaran(){
        $res = $this->client->request('GET', 'http://localhost:1000/tahun/get_all_tahun');
        $data = json_decode($res->getBody()->getContents(), true);
        // dd($data);
        return view('role/admin/tahun_ajaran', $data);
    }

    public function insertTahun(){
        $mulai = $this->request->getPost('tahun_mulai');
        $selesai = $this->request->getPost('tahun_selesai');
        $semester   = $this->request->getPost('semester');

        // $data = [
        //     'id' => $id,
        //     'tahun_mulai'   => $mulai,
        //     'tahun_selesai' => $selesai,
        //     'semester'      => $semester
        // ];

        $res = $this->client->request('POST', 'http://localhost:1000/tahun/saveTahun', [
            'json' => [
                'tahun_mulai'   => $mulai,
                'tahun_selesai' => $selesai,
                'semester'      => $semester
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
        
        return redirect()->to(base_url().'tahun/tahun_ajaran')->with('success', $res['message']);

    }
}
