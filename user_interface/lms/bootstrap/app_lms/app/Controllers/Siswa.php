<?php

namespace App\Controllers;
use GuzzleHttp\Client;
class Siswa extends BaseController
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
        echo 'belum ada halaman';
    }

    public function daftar_siswa()
    {
        // get_all_siswa
        $res_jurusan = $this->client->request('GET', 'http://localhost:1000/jurusan/get_all_jurusan');
        $res_jurusan = json_decode($res_jurusan->getBody()->getContents(), true);

        $res = $this->client->request('GET', 'siswa/get_all_siswa');
        $res = json_decode($res->getBody()->getContents(), true);
        
        $data = [
            'datas'     => $res['datas'],
            'jurusan'   => $res_jurusan['datas']
        ];

        // dd($data['jurusan']);
        return view('role/admin/daftar_siswa', $data);
    }
    public function formAddSiswa(){
        $tahun = $this->client->request('GET', 'http://localhost:1000/tahun/get_all_tahun');
        $tahun = json_decode($tahun->getBody()->getContents(), true);

        $jurusan = $this->client->request('GET', 'http://localhost:1000/jurusan/get_all_jurusan');
        $jurusan = json_decode($jurusan->getBody()->getContents(), true);

        $data = [
            'jurusan' => $jurusan['datas'],
            'tahun'   => $tahun['datas']
        ];
        // dd($data);

        return view('role/admin/form/formAddSiswa', $data);
    }

    public function nimOtomatis(){
        $res = $this->client->request('GET', 'http://localhost:1000/siswa/nimOtomatis');
        $res = json_decode($res->getBody(), true);
        $res = json_encode($res['datas']);
        return $this->response->setJSON($res);
    }

    public function insertSiswa(){
        
        $res = $this->client->request('POST', 'http://localhost:1000/siswa/saveSiswa', [
            'json' => [
                'nis'            => $this->request->getPost('nisSiswa'),
                'nama_siswa'     => $this->request->getPost('namaSiswa'),
                'jurusan'        => $this->request->getPost('jurusan'),
                'id_kelas'       => $this->request->getPost('kelas'),
                'jenis_kelamin'  => $this->request->getPost('jenisKelamin'),
                'id_tahun'       => $this->request->getPost('tahunMasuk'),
                'alamat'         => $this->request->getPost('alamat'),
                'tgl_lahir'      => $this->request->getPost('tanggalLahir'),
                'nama_ayah'      => $this->request->getPost('namaAyah'),
                'nama_ibu'       => $this->request->getPost('namaIbu'),
                'status'         => $this->request->getPost('status'),
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
        return redirect()->to(base_url().'siswa/daftar_siswa')->with('success', $res['message']);
        // dd($res);
    }

}
