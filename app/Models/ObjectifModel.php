<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectifModel extends Model
{
    protected $table = 'objectif';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nom_objectif'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'nom_objectif' => 'required|min_length[3]|is_unique[objectif.nom_objectif,id,{id}]',
    ];
    protected $validationMessages = [
        'nom_objectif' => [
            'is_unique' => 'Cet objectif existe déjà',
        ],
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}
