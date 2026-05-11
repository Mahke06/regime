<?php

namespace App\Models;

use CodeIgniter\Model;

class CodeModel extends Model
{
    protected $table = 'code';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['code', 'montant', 'utilise'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'code' => 'required|max_length[50]|is_unique[code.code,id,{id}]',
        'montant' => 'required|is_natural',
        'utilise' => 'in_list[0,1]',
    ];
    protected $validationMessages = [
        'code' => [
            'is_unique' => 'Ce code existe déjà',
        ],
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}
