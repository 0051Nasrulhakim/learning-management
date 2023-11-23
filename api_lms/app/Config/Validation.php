<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    
    public $validate_jurusan = [
        'jurusan' => [
            'rules' => 'required|is_unique[jurusan.jurusan]',
            'errors'=>[
                'required'  => 'Jurusan Harus Diisi',
                'is_unique' => 'Jurusan Sudah Ada'
            ]
        ],
        'singkatan'   => [
            'rules' => 'required|is_unique[jurusan.singkatan]',
            'errors' => [
                'required'  => 'Singkatan Harus Di Isi',
                'is_unique' => 'Singkatan Sudah Ada'
            ]
        ],
    ];

    public $validate_update_jurusan = [
        'id_jurusan'=> [
            'rules' => 'required',
            'errors'=> [
                'required'  => 'id tidak boleh kosong'
            ]
        ], 
        'jurusan' => [
            'rules' => 'required|is_unique[jurusan.jurusan,id_jurusan,{id_jurusan}]',
            'errors'=>[
                'required'  => 'Jurusan Harus Diisi',
                'is_unique' => 'Jurusan Sudah Ada'
            ]
        ],
        'singkatan'   => [
            'rules' => 'required|is_unique[jurusan.singkatan,id_jurusan,{id_jurusan}]',
            'errors' => [
                'required'  => 'Singkatan Harus Di Isi',
                'is_unique' => 'Singkatan Sudah Ada'
            ]
        ],
    ];

    public $validate_kelas = [
        'tingkat_kelas'=> [
            'rules' => 'required',
            'errors'=> [
                'required'  => 'Tingkat Kelas tidak boleh kosong'
            ]
        ], 
        'rombel' => [
            'rules' => 'required',
            'errors'=>[
                'required'  => 'Rombel Harus Diisi',
            ]
        ],
        'id_jurusan'   => [
            'rules' => 'required',
            'errors' => [
                'required'  => 'Jurusan Harus Di Isi',
            ]
        ],
    ];

    public $validate_siswa = [
        'nis'   => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'NIS Siswa Harus Diiisi'
            ]
        ],
        'nama_siswa' => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Nama Siswa Harus Diiisi'
            ]
        ],
        'jurusan' => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Jurusan Harus Diiisi'
            ]
        ],
        'id_kelas' => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Kelas Harus Diiisi'
            ]
        ],
        'jenis_kelamin' => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Jenis Kelamin Harus Diiisi'
            ]
        ],
        'id_tahun'   => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Tahun Masuk Harus Diiisi'
            ]
        ],
        'tgl_lahir' => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Tanggal Lahir Harus Diiisi'
            ]
        ],
        'nama_ayah'     => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Nama Ayah Harus Diiisi'
            ]
        ],
        'nama_ibu'      => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Nama Ibu Harus Diiisi'
            ]
        ],
        'alamat'        => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Alamat Harus Diiisi'
            ]
        ],
        'status'        => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'status Siswa Harus Diiisi'
            ]
        ],
    ];

    public $validate_tahun = [
        'tahun_mulai'    => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Tahun Mulai Harus Diisi'
            ]
        ],
        'tahun_selesai'    => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Tahun Selesai Harus Diisi'
            ]
        ],
        'semester'    => [
            'rules' => 'required',
            'errors'=> [
                'required' => 'Semester Harus Diisi'
            ]
        ],
    ];
}
