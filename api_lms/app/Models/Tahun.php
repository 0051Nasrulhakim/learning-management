<?php

namespace App\Models;

use CodeIgniter\Model;

class Tahun extends Model
{
    protected $table            = 'tahun_ajaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['id','tahun_mulai','tahun_selesai','semester','status'];

}
